/**
 * Created by chaow on 6/27/2016.
 */

var app = new AdminApp({
    el: 'body',
    components: {
        'question-text-field': QuestionTextField,
        'question-textarea-field': QuestionTextAreaField,
        'question-select': QuestionSelect,
        'question-select-with-text': QuestionSelectWithText,
        'question-multi-checkbox': QuestionMultiCheckbox,
        'province-amphur-district': ProvinceAmphurDistrict,
    },
    data: {
        newFarmer: null,
        options: {},
        isLoaded: false
    },

    methods: {
        sumCattle: function (option) {
            var sum = 0;
            //console.log('option', option);

            for (var i = 0; i < option.length; i++) {
                var objOption = option[i];
                //console.log('objOption', objOption);
                sum += parseInt(objOption.pivot.amount) ? parseInt(objOption.pivot.amount) : 0;
            }

            return sum;
        },
        sumSubChildCattle: function (option) {
            var subChildOption = this.newFarmer[option[0].type];
            //console.log("sumSubChildCattle", subChildOption);
            var sum = 0;
            for (var i = 0; i < subChildOption.length; i++) {
                var subOption = subChildOption[i];
                sum += parseInt(subOption.pivot.amount) ? parseInt(subOption.pivot.amount) : 0;
            }

            return sum;

        },
        save: function () {

            this.$http.patch('/api/farm-owner/' + this.newFarmer.id, this.newFarmer).then(function (response) {
                data = response.data;
                this.newFarmer = data;
                this.reSelectedOption();
            })
        }
        ,
        reInitialOption: function (opt) {
            //console.log(opt);
            if (this.newFarmer[opt] & this.newFarmer[opt].id) {
                for (var i = 0; i < this.options[opt].length; i++) {
                    if (this.options[opt][i].id == this.newFarmer[opt].id) {
                        this.options[opt].splice(i, 1, this.newFarmer[opt]);
                    }
                }
            }

        }
        ,
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
        }
        ,
        reSelectedOption: function () {

            var attributes = [
                //part1
                'sex', 'family_status', 'education', 'social_status', 'personal_status',
                'cattle_job', 'income_range',
                //part2
                'farm_record', 'farm_exp', 'farm_future',
                'farm_register_status',
                'farm_register',
                'farm_disease_check', 'abortion',
                'tuberculosis', 'foot_mouth_disease',

                //part7
                'support_visit', 'production_support', 'cattle_heath_support',
                'training_support', 'observe_support', 'female_breeder_support'

            ];

            for (var i = 0; i < attributes.length; i++) {
                this.reInitialOption(attributes[i]);
            }

            var multipleAttributes = [
                //part1
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
                'female_under_six_mixed_breeding_types',

                //part5
                'budget_sources', 'loan_types',

                //part7
                'support_sources'
            ]

            for (var i = 0; i < multipleAttributes.length; i++) {
                this.reInitialMultiOption(multipleAttributes[i]);
            }

        }
        ,
        initial: function () {


        }
    }
    ,
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
                        this.isLoaded = true;
                        this.reSelectedOption();

                    }
                )

            }
        })
    }
    ,
    ready: function () {


    }
})