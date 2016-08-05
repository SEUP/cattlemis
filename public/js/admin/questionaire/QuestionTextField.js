/**
 * Created by chaow on 6/27/2016.
 */

var QuestionTextField = Vue.extend({
    template: `
    <div class="form-group">
            <label class="col-sm-2 control-label">{{label}}</label>
            <div class="col-sm-10">
                <input type="{{type}}" v-model="model" class="form-control" placeholder="{{placeholder}}"/>
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
        placeholder: {
            required: false,
            default: function () {
                return this.label
            }
        },
        type: {
            required: false,
            default: function () {
                return "text"
            }
        }
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

var QuestionRadio = Vue.extend({
    template: `
    <div class="form-group">
            <label class="col-sm-2 control-label">{{label}}</label>
            <div class="col-sm-10">
                <div class="radio" v-for="option in options">
                    <label>
                        <input type="radio" v-bind:value="option" v-model="model" >
                            {{ option.choice }}
                    </label>
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
        }
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
            this.$http.get('/api/thailand/province/' + this.model_province + "/amphure").then(function (r) {
                this.amphurs = r.data;
            })
        },

        amphurChange: function () {
            this.model_district = 0;
            this.$http.get('/api/thailand/province/' + this.model_province + "/amphure/" + this.model_amphur + "/district").then(
                function (r) {
                    this.districts = r.data;
                })
        }
    },

    ready: function () {
        var self = this;

        // DOM updated
        self.$http.get("/api/thailand/province").then(function (response) {
            self.provinces = response.data;

            if (self.model_province) {
                this.$http.get('/api/thailand/province/' + this.model_province + "/amphure").then(function (r) {
                    this.amphurs = r.data;

                    if (self.model_amphur) {
                        this.$http.get('/api/thailand/province/' + this.model_province + "/amphure/" + this.model_amphur + "/district"
                        ).then(function (r) {
                            this.districts = r.data;
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
                        <input  type="{{type}}" v-model="model.pivot[pivotfield]"
                               class="form-control col-sm-6" placeholder="{{placeholder}}"/>
                    </div>
                </div>

            </div>
        </div>
    `,
    props: {
        label: {
            required: true,
        },
        pivotfield: {
            required: false,
            default: "remark"
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
        },
        type: {
            required: false,
            default: function () {
                return "text"
            }
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
                {{ option.choice }}
                <template v-if="option.has_text">:</template>
                <input type="{{type}}" v-if="option.has_text" placeholder="{{placeholder}}" type="text" class="form-control"
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
        },
        type: {
            required: false,
            default: function () {
                return "text"
            }
        }
    }
});
