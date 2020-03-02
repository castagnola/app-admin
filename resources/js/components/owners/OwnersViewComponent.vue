<template>
    <div class="container">
        <div class="card">
            <div class="card-header text-white bg-dark"><span><i
                class="fas fa-user-alt-slash"></i> Driver Information</span></div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-4 col-form-label">
                            <input type="text" class="form-control"
                                   v-model="owner.first_name +'   '+ owner.second_name" readonly>
                        </div>
                        <label class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-4 col-form-label">
                            <input type="text" class="form-control" v-model="owner.last_name" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Identification</label>
                        <div class="col-sm-4 col-form-label">
                            <input type="text" class="form-control" v-model="owner.identification_number" readonly>
                        </div>
                        <label class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-4 col-form-label">
                            <input type="text" class="form-control" v-model="owner.address" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Phone number</label>
                        <div class="col-sm-4 col-form-label">
                            <input type="text" class="form-control" v-model="owner.phone_number" readonly>
                        </div>
                        <label class="col-sm-2 col-form-label">City</label>
                        <div class="col-sm-4 col-form-label">
                            <input type="text" class="form-control" v-model="owner.city.city_name" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-header text-white bg-dark"><span> <i class="fas fa-car"></i> Vehicle Information</span>
            </div>
            <div class="card-body">
                <div class="tab-content">

                </div>
            </div>
            <div class="card-footer bg-transparent border-dark">
                <button type="button" class="btn btn-primary" v-on:click="$router.go(-1)"><i
                    class="fas fa-arrow-circle-left"></i> Back
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "OwnersViewComponent",
        created() {
            this.loadViewOwner();

        },
        data(){
            return {
                owner: [],
            }
        },
        methods:{
            loadViewOwner(){
                let id = this.$route.params.id;
                axios.get(`api/owners/${id}`).then((res) => {
                    console.log(res.data);
                    this.owner = res.data;
                })
            }
        }
    }
</script>

<style scoped>

</style>
