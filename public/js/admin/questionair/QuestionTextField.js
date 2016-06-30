/**
 * Created by chaow on 6/27/2016.
 */

var QuestionTextField = Vue.extend({
    template: `
    <div class="form-group">
            <label class="col-sm-2 control-label">{{label}}</label>
            <div class="col-sm-10">
                <input type="text" v-model="model" class="form-control" placeholder="{{placeholder}}"/>
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
        },
        placeholder: {}
    }
});

var QuestionTextAreaField = Vue.extend({
    template: `
    <div class="form-group">
            <label class="col-sm-2 control-label">{{label}}</label>
            <div class="col-sm-10">
            ​    <textarea v-model="model" class="form-control" rows="10" cols="70" placeholder="{{placeholder}}"></textarea>
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
        },
        placeholder: {}
    }
});


var QuestionSelect = Vue.extend({
    template: `
    <div class="form-group">
            <label class="col-sm-2 control-label">{{label}}</label>
            <div class="col-sm-10">
                <select class="form-control" v-model="model">
                    <option selected value="">กรุณาเลือก</option>
                    <option v-for="option in options"
                            v-bind:value="option">{{ option.choice }}</option>
                </select>
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
        },
        options: {
            required: true,
            twoWay: true
        }
    }
});

var ProvinceAmphurDistrict = Vue.extend({

    template: `
    <div class="form-group">
            <label class="col-sm-2 control-label" >จังหวัด</label>
            <div class="col-sm-10">
                <select class="form-control" v-on:change="provinceChange" v-model="model_province" >
                    <option value="0">กรุณาเลือก</option>
                    <option v-for="option in provinces"
                            v-bind:value="option.PROVINCE_ID">{{ option.PROVINCE_NAME }}</option>
                </select>
            </div>
        </div>
    <div class="form-group">
        <label class="col-sm-2 control-label" >อำเภอ</label>
        <div class="col-sm-10">
            <select class="form-control" v-on:change="amphurChange" v-model="model_amphur" >
                <option value="0">กรุณาเลือก</option>
                <option v-for="option in amphurs"
                        v-bind:value="option.AMPHUR_ID">{{ option.AMPHUR_NAME }}</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label" >ตำบล</label>
        <div class="col-sm-10">
            <select class="form-control" v-on:change="districtChange" v-model="model_district" >
                <option value="0">กรุณาเลือก</option>
                <option v-for="option in districts"
                        v-bind:value="option.DISTRICT_ID">{{ option.DISTRICT_NAME }}</option>
            </select>
        </div>
    </div>
    `,

    props: {
        provinces: {},
        amphurs: {},
        districts: {},

        model_province: {
            required: true,
            twoWay: true
        },
        model_amphur: {
            required: true,
            twoWay: true
        },
        model_district: {
            required: false,
            twoWay: true
        },
    },
    methods: {
        provinceChange: function () {
            this.model_amphur = 0
            this.model_district = 0;
            this.$http.get('/api/thailand/province/' + this.model_province + "/amphure", function (r) {
                this.amphurs = r;
            })
        },

        amphurChange: function () {
            this.model_district = 0;
            this.$http.get('/api/thailand/province/' + this.model_province + "/amphure/" + this.model_amphur + "/district",
                function (r) {
                    this.districts = r;
                })
        }
    },

    ready: function () {
        var self = this;

        // DOM updated
        self.$http.get("/api/thailand/province", function (response) {
            self.provinces = response;

            if (self.model_province) {
                this.$http.get('/api/thailand/province/' + this.model_province + "/amphure", function (r) {
                    this.amphurs = r;

                    if (self.model_amphur) {
                        this.$http.get('/api/thailand/province/' + this.model_province + "/amphure/" + this.model_amphur + "/district",
                            function (r) {
                                this.districts = r;
                            })
                    }

                })
            }

        });

    }

})


var QuestionSelectWithText = Vue.extend({
    template: `
   <div class="form-group">
            <label class="col-sm-2 control-label">{{label}}</label>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-6">
                        <select class="form-control " v-model="model">
                            <option selected value="">กรุณาเลือก</option>
                            <option v-for="option in options"
                                    v-bind:value="option">{{ option.choice }}</option>
                        </select>
                    </div>
                    <div class="col-sm-6" v-if="model.has_text==1">
                        <input type="text" 
                        placeholder="{{placeholder}}"
                         v-model="model.pivot.remark"
                               class="form-control col-sm-6" />
                    </div>
                </div>

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
        },
        options: {
            required: true,
            twoWay: true
        },
        placeholder: {
            required: false,
            default: "โปรดระบุ"
        }
    }
});


var QuestionMultiCheckbox = Vue.extend({
    template: `
<div class="form-group">
    <div class="col-sm-3">
        <label>{{label}}</label>
    </div>
    <div class="col-sm-9">
        <label class="checkbox" v-for="option in options">
            <input type="checkbox" v-model="model" v-bind:value="option">
                {{ option.choice }}:
                <input v-if="option.has_text" placeholder="{{placeholder}}" type="text" class="form-control"
                       v-model="option['pivot']['remark']">
        </label>
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
        },
        options: {
            required: true,
            twoWay: true
        },
        placeholder: {
            required: false,
            default: "โปรดระบุ"
        }
    }
});
