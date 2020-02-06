<template>
    <div class="container">
        <div class="row mt-5">
            <div style="margin-top: 10px" class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User List</h3>
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
                                <th>Color</th>
                                <th>Placa</th>
                                <th>Brand</th>
                                <th>Tipe Vehicle</th>
                                <th>Driver</th>
                                <th>Owner</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Color</td>
                                <td>Placa</td>
                                <td>Brand</td>
                                <td>Tipe Vehicle</td>
                                <td>Driver</td>
                                <td>Owner</td>
                                <td>Status</td>
                                <td>Action</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit blue"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm">
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
    </div>
</template>

<script>
    export default {
        name: "VehiclesComponent"
    }
</script>

<style scoped>

</style>
