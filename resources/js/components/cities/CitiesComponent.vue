<template>
    <div class="container">
        <div class="row mt-5">
            <div style="margin-top: 10px" class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Cities List</h3>
                        <div class="card-tools">
                            <button v-if="$gate.isAdmin()" type="button" class="btn btn-block btn-outline-success"
                                    v-on:click="newModal()">Add
                                new
                                <i class="fas fa-city"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>City Name</th>
                                <th>Departament</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="city in cities.data" :key="city.id">
                                <td>{{city.city_name}}</td>
                                <td>{{city.departament.departament_name}}</td>
                                <td>{{city.status === 1 ? 'Activo' : 'Desactivo'}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" v-on:click="editModal(owner)">
                                        <i class="fa fa-edit blue"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm"
                                            v-on:click="deleteCity(owner.id)">
                                        <i class="fa fa-trash red"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- pagination --->
                    <div class="card-footer">
                        <pagination :data="cities" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
            </div>
        </div>

        <!--Modal -->
        <div class="modal fade" id="addOwners" tabindex="-1" role="dialog" aria-labelledby="addOwnersLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="addOwnersLabel">Add New <i
                                class="fas fa-city"></i>
                        </h5>
                        <h5 class="modal-title" v-show="editmode" id="addOwnersLabel">Update Owner <i
                                class="fas fa-city"></i></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? update() : create()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.city_name" type="text" name="city_name"
                                       placeholder="City Name"
                                       class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('city_name') }">
                                <has-error :form="form" field="city_name"></has-error>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i
                                    class="fas fa-times"></i></button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Save <i
                                    class="fas fa-check"></i></button>
                            <button v-show="!editmode" type="submit" class="btn btn-success">Create <i
                                    class="fas fa-plus"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "CitiesComponent",
        data() {
            return {
                cities: {},
                editmode: false,
                form: new Form({
                    id: '',
                    city_name: '',
                    departament:[],
                })
            }
        },
        methods: {
            getResults(page = 1) {
                axios.get('api/city?page=' + page)
                    .then(response => {
                        this.cities = response.data;
                    });
            },

            /**
             * Load all cities
             */
            loadCities() {
                axios.get(`api/city`)
                    .then((res) => {
                        this.cities = res.data
                    })
            },

            /**
             * Show modal to create new city
             */
            newModal() {
                this.editmode = false;
                this.form.reset();
                this.form.clear();
                $('#addOwners').modal('show');
            },

            /**
             * Create a new City
             */
            create() {
                this.editmode = false;
                this.form.post('api/city')
                    .then(() => {
                        vm.$emit('afterCreate');
                        $('#addOwners').modal('hide')
                        toast.fire('Success!', 'City Created in successfully.', 'success');
                    })
                    .catch(() => {
                        toast.fire('Uops!', 'Complete all fields!', 'warning');
                    })
            },

            /**
             * Update  City
             */
            update() {
                this.form.put('api/city/' + this.form.id)
                    .then((res) => {
                        // success
                        $('#addOwners').modal('hide');
                        toast.fire('Updated!', 'User: ' + res.data.first_name.toUpperCase() + ' has been updated.', 'success')
                        vm.$emit('afterUpdate', res);
                    }).catch(() => {
                    toast.fire('Error!', 'There was something wronge.', 'error')
                });
            },

            /**
             * Delete City
             * @param id
             */
            deleteCity(id) {
                swal.fire({
                    title: 'Are you sure?',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete'
                }).then((result) => {
                    // Send request to the server
                    if (result.value) {
                        this.form.delete('api/owners/' + id).then(() => {
                            toast.fire('Success!', 'User has been deleted.', 'success');
                            vm.$emit('afterCreate');
                        }).catch(() => {
                            toast.fire('Error!', 'There was something wronge.', 'error');
                        });
                    }
                })
            },


            /**
             * Show and complete city info
             * @param data
             */
            editModal(data) {
                this.editmode = true;
                this.form.reset();
                this.form.clear();
                $('#addOwners').modal('show');
                this.form.fill(data);
            },

            /**
             * Show modal to create new city
             */
            newModal() {
                this.editmode = false;
                this.form.reset();
                this.form.clear();
                $('#addOwners').modal('show');
            },
        },

        /**
         * Methods first charge
         */
        created() {
            this.loadCities();
            vm.$on('afterCreate', () => {
                this.loadCities();
            });
            //event
            vm.$on('afterUpdate', (res) => {
                const index = this.cities.findIndex(itemSearch => itemSearch.id === res.data.id);
                this.cities[index].city_name = res.data.cities.city_name
            })
        }


    }
</script>

<style scoped>

</style>
