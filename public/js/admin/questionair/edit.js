/**
 * Created by chaow on 6/27/2016.
 */

var QuestionTextField = Vue.extend({
    template: `
    <div class="form-group">
            <label class="col-sm-2 control-label">{{label}}</label>
            <div class="col-sm-10">
                <input type="text" v-model="model" class="form-control"/>
            </div>
        </div>
    `,
    props: {
        label: {
            required: true,
        },
        model: {
            required: true,
            twoWay: true
        }
    }
})

var app = new AdminApp({
    el: 'body',
    components: {
        'question-text-field': QuestionTextField
    },
    data: {
        newFarmer: {},
        options: {}
    },

    methods: {
        sumCattle: function (option) {
            var optType = option;
            var sum = 0;
            for (var i = 0; i < optType.length; i++) {
//                        console.log("opttype", optType[i]);
                if (optType[i].pivot.amount != null) {
//                            console.log(optType[i].pivot.amount, sum);
                    sum += parseInt(optType[i].pivot.amount) ? parseInt(optType[i].pivot.amount) : 0;
                } else {
                    var childtype = this.newFarmer[optType[i].children[0].type]
//                            console.log("opttype for children", childtype);
                    for (var j = 0; j < childtype.length; j++) {
                        if (childtype[j].pivot.amount != null) {
//                                    console.log(childtype[j].pivot.amount, sum);
                            sum += parseInt(childtype[j].pivot.amount) ? parseInt(childtype[j].pivot.amount) : 0;
                        }
                    }
                }
                //console.log("total_" + optType[i].type);
                this.newFarmer.farm_info["total_" + optType[i].type] = sum;
            }

            return sum;
        },
        save: function () {
            this.$http.patch('/api/farm-owner/' + this.newFarmer.id, this.newFarmer).then(function (response) {
                data = response.data;
                this.newFarmer = data;
                this.reSelectedOption();
            })
        },
        reInitialOption: function (opt) {
            for (var i = 0; i < this.options[opt].length; i++) {
                if (this.options[opt][i].id == this.newFarmer[opt].id) {

                    if (this.options[opt][i].has_text == 1 && this.newFarmer[opt].has_text == 1) {
                        this.options[opt][i].pivot = this.newFarmer[opt].pivot;
                        this.newFarmer[opt] = this.options[opt][i];
                    } else {
                        this.newFarmer[opt] = this.options[opt][i];
                    }
                }
            }
        },
        reInitialMultiOption: function (opt) {

            var choiceOpt = this.options[opt];
            var userOpt = this.newFarmer[opt];

            for (var i = 0; i < choiceOpt.length; i++) {
                //console.log("choice", choiceOpt[i].id, choiceOpt[i].choice)

                for (var j = 0; j < userOpt.length; j++) {

                    //console.log("user", userOpt[j])
                    if (choiceOpt[i].id == userOpt[j].id) {
                        choiceOpt.splice(i, 1, userOpt[j]);
                        break;
                    }
                }
            }
        },
        reSelectedOption: function () {

            var attributes = [
                'sex', 'family_status', 'education', 'social_status', 'personal_status',
                'cattle_job', 'income_range',
                //part2
                'farm_record', 'farm_exp', 'farm_future',
                'farm_register_status', 'farm_register', 'farm_disease_check', 'abortion',
                'tuberculosis', 'foot_mouth_disease'];

            for (var i = 0; i < attributes.length; i++) {
//                        console.log(attributes[i]);
                this.reInitialOption(attributes[i]);
            }

            var multipleAttributes = [
                'jobtypes',
                //part 2
                'farm_purposes', 'male_breeding_types',
                'male_int_breeding_types', 'male_mixed_breeding_types', 'female_breeding_types',
                'female_int_breeding_types', 'female_mixed_breeding_types', 'male_over_six_breeding_types',
                'male_over_six_int_breeding_types', 'male_over_six_mixed_breeding_types',
                'female_over_six_breeding_types', 'female_over_six_int_breeding_types',
                'female_over_six_mixed_breeding_types', 'male_under_six_breeding_types',
                'male_under_six_int_breeding_types', 'male_under_six_mixed_breeding_types',
                'female_under_six_breeding_types', 'female_under_six_int_breeding_types',
                'female_under_six_mixed_breeding_types'
            ]

            for (var i = 0; i < multipleAttributes.length; i++) {
                this.reInitialMultiOption(multipleAttributes[i]);
            }

        },
        initial: function () {


        }
    },
    created: function () {
        var self = this;

        $.ajax({
            url: '/api/choice',
            type: 'get',
            dataType: 'json',
            async: 'false',
            success: function (response) {

                self.options = response;
                self.newFarmer_id = $("#newFamer_id").val();
                self.$http.get('/api/farm-owner/' + self.newFarmer_id + '/edit').then(
                    function (response) {
                        this.newFarmer = response.data;
                        this.reSelectedOption();
                    }
                )

            }
        })
    },
    ready: function () {


    }
})