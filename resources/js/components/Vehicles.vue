<template>
    <div class="container">
        <h1>{{status}}</h1>

        <!-- Form for creating a vehicle -->
        <button v-on:click="isCreateVehicle = !isCreateVehicle" class="btn btn-primary mb-5">Registrer nytt kjøretøy</button>
        <form v-if="isCreateVehicle">
            <div class="form-group">
                <label for="formGroupExampleInput">Merke_id</label>
                <input v-model="vehicle.brand_id" type="text" class="form-control" id="formGroupExampleInput" placeholder="merke_id">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Model_id</label>
                <input v-model="vehicle.vehicle_model_id" type="text" class="form-control" id="formGroupExampleInput2" placeholder="model_id">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Registreringsnummer</label>
                <input v-model="vehicle.license_plate" type="text" class="form-control" id="formGroupExampleInput2" placeholder="registreringsnummer">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Årsmodell</label>
                <input v-model="vehicle.year_model" type="text" class="form-control" id="formGroupExampleInput2" placeholder="årsmodell">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Kilometerstand</label>
                <input v-model="vehicle.mileage" type="text" class="form-control" id="formGroupExampleInput2" placeholder="kilometerstand">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">registreringsdato format=(2020-11-23)</label>
                <input v-model="vehicle.registration_date" type="text" class="form-control" id="formGroupExampleInput2" placeholder="registreringsdato (2020-11-23)">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">Veteran</label>
                <input v-model="vehicle.veteran" type="text" class="form-control" id="formGroupExampleInput2" placeholder="veteran">
            </div>
                    <button v-on:click="createVehicle()" type="button" class="btn btn-success">Registrer kjøretøy</button>
        </form>

        <!-- Sortering -->
        <form class="mb-4">
            <label class="font-weight-bold">Sorter på merker:</label>
            <div v-for="brand in brands" v-bind:key="brand.id" class="form-check">
                <input v-bind:value="brand.id" v-model="userSelectedBrands" type="checkbox"  class="form-check-input" >
                <label class="form-check-label">{{brand.name}}</label>
            </div>
        </form>
        <!-- Cards for vehicles -->
        <div v-if="isFetched" class="card" style="width: 18rem;">
            <div v-for="vehicle in vehicles" v-bind:key="vehicle.id" class="card-body">
                <h4 class="card-title">{{vehicle.vehicle_model_name}}</h4>
                <h5 class="card-subtitle mb-2 text-muted">{{vehicle.brand_name}}</h5>
                <h6 class="card-subtitle mb-2">Registreringsnummer: {{vehicle.license_plate}}</h6>
                <h6 class="card-subtitle mb-2">Årsmodell: {{vehicle.year_model}}</h6>
                <h6 class="card-subtitle mb-2">Kilometerstand: {{vehicle.mileage}}km</h6>
                <h6 class="card-subtitle mb-2">Registreringsdato: {{vehicle.registration_date}}</h6>
                <h6 class="card-subtitle mb-2" v-if="vehicle.veteran">Veteran: Ja</h6>
                <h6 class="card-subtitle mb-2" v-else>Veteran: Nei</h6>
                <button type="button" class="btn btn-warning"><router-link to="/rediger">Rediger</router-link></button>
                <button v-on:click="deleteVehicle(vehicle.id)" type="button" class="btn btn-danger">Slett</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                vehicles : [],
                brands: [],
                userSelectedBrands: [],

                isFetched : false,
                status: "",
                isCreateVehicle: false,

                //Vehicle object
                vehicle: {
                    brand_id: 1,
                    vehicle_model_id: 1,
                    license_plate: "",
                    year_model: "",
                    mileage: 0,
                    registration_date: "2020-11-22",
                    veteran: false
                }
            }
        },

        created() {
            this.getVehicles();
            this.getBrands();
        },

        watch: {
            userSelectedBrands: function() {
                if(this.userSelectedBrands.length === 0) {
                    this.getVehicles();
                }
                else {
                    this.getVehiclesSortedByBrands();
                }
            }
        },

        methods: {
            getVehicles() {
                axios.get("api/vehicles/").then(
                    result => {
                        this.vehicles = result.data.data
                        this.isFetched = true
                    }
                );
            },

            getBrands() {
                axios.get("api/brands").then(
                    result => {
                        this.brands = result.data.data
                        
                    }
                );
            },

            deleteVehicle(vehicleId) {
                axios.delete("api/vehicle/" + vehicleId).then(
                    result => {
                        this.getVehicles()
                        this.status = "Kjøretøy slettet!"
                    }
                );
            },

            createVehicle() {
                axios({
                    method: 'post',
                    url: 'api/vehicle',
                    data: JSON.stringify({
                        brand_id: this.vehicle.brand_id,
                        vehicle_model_id: this.vehicle.vehicle_model_id,
                        license_plate: this.vehicle.license_plate,
                        year_model: this.vehicle.year_model,
                        mileage: this.vehicle.mileage,
                        registration_date: this.vehicle.registration_date,
                        veteran: this.vehicle.veteran
                    }),
                    headers: {
                        'Content-Type': 'text/plain;charset=utf-8',
                    },
                }).then(function (response) {
                    console.log(response);
                }).catch(function (error) {
                    console.log(error);
                });
                
            },
            getVehiclesSortedByBrands() {
                const sortedVehicles = [];

                this.vehicles.forEach((e1)=>this.userSelectedBrands.forEach((e2)=>
                    {
                    if(e1.brand_id == e2){
                        sortedVehicles.push(e1);
                    }
                    }
                ));
                this.vehicles = sortedVehicles;

                },
                    removeUserselectedBrands(index) {
                    this.userSelectedBrands.splice(index, 1);
                }
        }
    }
</script>

<style scoped>

</style>
