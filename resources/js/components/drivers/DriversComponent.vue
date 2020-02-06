<template>
    <div class="container">
        <div class="row mt-5">
            <div style="margin-top: 10px" class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Drivers List</h3>
                        <div class="card-tools">
                            <button v-if="$gate.isAdmin()"  type="button" class="btn btn-block btn-outline-success" v-on:click="newModal()">Add
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
                            <tr v-for="user in users" :key="user.id">

                                <td>{{user.id}}</td>
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td>{{user.roles.description | upText}}</td>
                                <td>{{user.status === 1 ? 'Activo' : 'Desactivo'}}</td>
                                <td>{{user.created_at | myDate}}</td>

                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" v-on:click="editModal(user)">
                                        <i class="fa fa-edit blue"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm"
                                            v-on:click="deleteUser(user.id)">
                                        <i class="fa fa-trash red"></i>
                                    </button>
                                    <router-link :to="{name:'user',params:{id:user.id}}">
                                        <button type="button" class="btn btn-success btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </router-link>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DriversComponent"
    }
</script>

<style scoped>

</style>
