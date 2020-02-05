<template>
    <div class="container">
        <div class="row mt-5">
            <div style="margin-top: 10px" class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Roles List</h3>
                        <div class="card-tools">
                            <button v-if="$gate.isAdmin()" type="button" class="btn btn-block btn-outline-success"
                                    v-on:click="newModal()">Add new
                                <i class="fas fa-user-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Date Created</th>
                                <th>Status</th>
                                <th  v-if="$gate.isAdmin()">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="role in roles" :key="role.id">
                                <td>{{role.id}}</td>
                                <td>{{role.name}}</td>
                                <td>{{role.description}}</td>
                                <td>{{role.created_at}}</td>
                                <td>{{role.status === 1 ? 'Activo' : 'Desactivo'}}</td>
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
        components:{

        },
        data() {
            return {
                roles: [],
                form: new Form({
                    id: '',
                    name: '',
                    description: '',
                    status: '',
                })
            }
        },
        methods: {
            loadRoles() {
                axios.get(`api/get-roles`)
                    .then(res => {
                        this.roles = res.data;
                    }).catch(error => {
                    toast.fire('Error!', 'Roles cannot be loaded', 'error');
                })
            },
            newModal(){

            }

        },
        created() {
            this.loadRoles();
        }
    }
</script>

<style scoped>

</style>
