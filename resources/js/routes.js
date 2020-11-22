import Vehicles from './components/Vehicles'
import EditVehicles from './components/EditVehicles'
import EditVehicleModels from './components/EditVehicleModels'
import EditBrands from './components/EditBrands'

export default [
    {
        path: '/',
        component: Vehicles
    },
    {
        path: '/redigerkjøretøy',
        component: EditVehicles
    },
    {
        path: '/redigermodeller',
        component: EditVehicleModels
    },
    {
        path: '/redigermerker',
        component: EditBrands
    },
]