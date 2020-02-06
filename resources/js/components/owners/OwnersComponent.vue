<template>
    <div class="container">
        <div class="row mt-5">
            <div style="margin-top: 10px" class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Owners List</h3>
                        <div class="card-tools">
                            <button v-if="$gate.isAdmin()" type="button" class="btn btn-block btn-outline-success"
                                    v-on:click="newModal()">Add
                                new
                                <i class="fas fa-user-plus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Identification Number</th>
                                <th>First Name</th>
                                <th>Second Name</th>
                                <th>Last name</th>
                                <th>Address</th>
                                <th>Phone Number</th>
                                <th>City</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="owner in owners" :key="owner.id">
                                <td>{{owner.identification_number}}</td>
                                <td>{{owner.first_name}}</td>
                                <td>{{owner.second_name}}</td>
                                <td>{{owner.last_name}}</td>
                                <td>{{owner.address}}</td>
                                <td>{{owner.phone_number}}</td>
                                <td>{{owner.city_id}}</td>
                                <td>{{owner.status === 1 ? 'Activo' : 'Desactivo'}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" v-on:click="editModal(owner)">
                                        <i class="fa fa-edit blue"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm"
                                            v-on:click="deleteOwner(owner.id)">
                                        <i class="fa fa-trash red"></i>
                                    </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
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
                                class="fas fa-user"></i>
                        </h5>
                        <h5 class="modal-title" v-show="editmode" id="addOwnersLabel">Update Owner <i
                                class="fas fa-user"></i></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? update() : create()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.identification_number" type="text" name="identification_number"
                                       placeholder="Identification"
                                       class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('identification_number') }">
                                <has-error :form="form" field="identification_number"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.first_name" type="text" name="first_name"
                                       placeholder="First Name"
                                       class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('first_name') }">
                                <has-error :form="form" field="first_name"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.second_name" type="text" name="second_name"
                                       placeholder="Second name"
                                       class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('second_name') }">
                                <has-error :form="form" field="second_name"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.last_name" type="text" name="last_name"
                                       placeholder="Last name"
                                       class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('last_name') }">
                                <has-error :form="form" field="last_name"></has-error>
                            </div>

                            <div class="form-group">
                                <input v-model="form.address" type="text" name="address"
                                       placeholder="address"
                                       class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('address') }">
                                <has-error :form="form" field="address"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.phone_number" type="text" name="phone_number"
                                       placeholder="Phone number"
                                       class="form-control"
                                       :class="{ 'is-invalid': form.errors.has('phone_number') }">
                                <has-error :form="form" field="phone_number"></has-error>
                            </div>

                            <div class="form-group">
                                <select name="role_id" v-model="form.city" id="city_id" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('city_id') }">
                                    <option value="" disabled selected>Select City</option>
                                    <option v-for="(city,key) in cities" :value="city.id">
                                        {{city.city_name}}
                                    </option>
                                </select>
                                <has-error :form="form" field="city_id"></has-error>
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
        name: "OwnersComponent",
        data() {
            return {
                owners: [],
                cities: [],
                editmode: false,
                form: new Form({
                    id: '',
                    identification_number: '',
                    first_name: '',
                    second_name: '',
                    last_name: '',
                    address: '',
                    phone_number: '',
                    city_id: '',
                })
            }
        },
        methods: {

            /**
             * Load all owners
             */
            loadOwners() {
                axios.get(`api/owners`)
                    .then((res) => {
                        this.owners = res.data
                    })
            },
            /**
             * Load all owners
             */
            loadCities() {
                axios.get(`api/cities`)
                    .then((res) => {
                        this.cities = res.data
                    })
            },

            /**
             * Show modal to create new user
             */
            newModal() {
                this.editmode = false;
                this.form.reset();
                this.form.clear();
                $('#addOwners').modal('show');
            },

            /**
             * Create a new Owner
             */
            create() {
                this.editmode = false;
                this.form.post('api/owners')
                    .then(() => {
                        vm.$emit('afterCreate');
                        $('#addOwners').modal('hide')
                        toast.fire('Success!', 'Owner Created in successfully.', 'success');
                    })
                    .catch(() => {
                        toast.fire('Uops!', 'Complete all fields!', 'warning');
                    })
            },

            /**
             * Update  Owner
             */
            update() {
                this.form.put('api/owners/' + this.form.id)
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
             * Delete Owner
             * @param id
             */
            deleteOwner(id) {
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
             * Show and complete owner info
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
             * Show modal to create new owner
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
            this.loadOwners();
            this.loadCities();
            vm.$on('afterCreate', () => {
                this.loadOwners();
            });
            //event
            vm.$on('afterUpdate', (res) => {
                const index = this.owners.findIndex(itemSearch => itemSearch.id === res.data.id);
                this.owners[index].identification_number = res.data.identification_number;
                this.owners[index].first_name = res.data.first_name;
                this.owners[index].last_name = res.data.last_name;
                this.owners[index].phone_number = res.data.phone_number;
                this.owners[index].second_name = res.data.second_name;
                this.owners[index].address = res.data.address;
                this.owners[index].cities.city_name = res.data.cities.city_name
            })
        }

    }
</script>

<style scoped>

</style>
