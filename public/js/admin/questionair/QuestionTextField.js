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


var QuestionSelect = Vue.extend({
    template: `
    <div class="form-group">
            <label class="col-sm-2 control-label">{{label}}</label>
            <div class="col-sm-10">
                <select class="form-control" v-model="model">
                    <option value="">กรุณาเลือก</option>
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

var ProvinceAmphureDistrict = Vue.extend({

    template: `
    <div class="form-group">
            <label class="col-sm-2 control-label">{{label}}</label>
            <div class="col-sm-10">
                <select class="form-control" v-model="model">
                    <option value="">กรุณาเลือก</option>
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
    },
    ready : function(){

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
                        <input type="text" v-model="model.pivot.remark"
                               class="form-control col-sm-6" placeholder="โปรดระบุ"/>
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
                <input v-if="option.has_text" type="text" class="form-control"
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
        }
    }
});
