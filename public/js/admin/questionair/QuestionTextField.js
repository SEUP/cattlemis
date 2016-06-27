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