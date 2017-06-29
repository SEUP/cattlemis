/**
 * Created by chaow on 9/11/2016.
 */
var app = new AdminApp({
    el: 'body',
    data: {
        provinces: {},
        amphurs: {},
        districts: {},
        breedings: {},
        user_id: 0,
        user_is_admin: 0,
        admin_level: 0,
        province: 0,
        amphur: 0,
        district: 0,

        farmOwners: [],
        farmOwnerPage: {},
        form: {
            keyword: "",
            province: 0,
            amphur: 0,
            district: 0,
            breeding: 0,
            breedChoice: "",
            page: "",
        }
    },
    methods: {

        cannotEdit: function (owner) {

            if (this.admin_level == "admin") return false;
            else if ((this.admin_level = 'user_province') && (this.province == owner.house_province)) return false;
            else if ((this.admin_level = 'user_amphur') && (this.amphur == owner.house_amphur)) return false;
            else if ((this.admin_level = 'user_district') && (this.district == owner.house_district)) return false;

            return true;

        },
        provinceChange: function () {
            this.form.amphur = 0
            this.form.district = 0;
            if (this.form.province != 0) {
                this.$http.get('api/thailand/province/' + this.form.province + "/amphure").then(function (r) {
                    this.amphurs = r.data;
                })
            }

        },

        amphurChange: function () {
            this.form.district = 0;
            if (this.form.amphur != 0) {
                this.$http.get('api/thailand/province/' + this.form.province + "/amphure/" + this.form.amphur + "/district").then(
                    function (r) {
                        this.districts = r.data;
                    })
            }

        },
        deleteFarmOwner: function (owner) {
            if (!this.cannotEdit(owner)) {
                var id = owner.id
                if (confirm("คุณต้องการลบข้อมูลเกษตกรรายนี้หรือไม่?")) {
                    this.$http.delete('api/farm-owner/' + id).then(function (response) {
                        this.search();
                    })
                }
            }

        },
        resetSearch: function () {

            this.form = {
                keyword: "",
                province: 0,
                amphur: 0,
                district: 0,
                breeding: 0,
                breedChoice: "",
                page: "",
            }
            this.search();

        },
        getBreedingText: function () {
            var breedingSel = $("#breeding")[0];
            if (breedingSel.selectedIndex != 0) {
                var opt = breedingSel.selectedOptions[0]
                var text = $(opt).html();
                return text.trim();
            }
            return null;
        },
        search: function () {
            this.gotoPage(1)
        },
        load: function () {
            this.$http.get('api/farm-owner', {params: this.form}).then(
                function (response) {
                    this.farmOwnerPage = response.data;
                    this.farmOwners = this.farmOwnerPage.data;

                    this.form.breedChoice = this.getBreedingText();

                },
                function (error) {

                }
            );
        },
        gotoPage: function (page) {
            this.form.page = page;
            this.load();
        }
    },
    ready: function () {
        var self = this;

        this.user_id = $("#user_id").attr('value')
        this.user_is_admin = $("#user_is_admin").attr('value')


        this.admin_level = $("#admin_level").attr('value')
        this.province = $("#province").attr('value');
        this.amphur = $("#amphur").attr('value');
        this.district = $("#district").attr('value');


        if (this.admin_level == "admin") {
            //do nothing
        }
        else if ((this.admin_level = 'user_province')) {
            self.form.province = this.province
            self.form.amphur = this.amphur
            self.form.district = this.district
        }
        else if ((this.admin_level = 'user_amphur')) {
            self.form.province = this.province
            self.form.amphur = this.amphur
            self.form.district = this.district
        }
        else if ((this.admin_level = 'user_district')) {
            self.form.province = this.province
            self.form.amphur = this.amphur
            self.form.district = this.district
        }


        self.$http.get("api/choice/master_breeding_types").then(function (response) {
            self.breedings = response.data;
        })

        self.$http.get("api/thailand/province").then(function (response) {
            self.provinces = response.data;

            if (self.form.province != 0) {
                this.$http.get('api/thailand/province/' + self.form.province + "/amphure").then(function (r) {
                    this.amphurs = r.data;

                    if (self.form.amphur != 0) {
                        this.$http.get('api/thailand/province/' + self.form.province + "/amphure/" + self.form.amphur + "/district"
                        ).then(function (r) {
                            this.districts = r.data;
                        })
                    }

                })
            }

        });
        this.search();
    }
})