import Vehicles from './components/Vehicles'
import Edit from './components/Edit'
import VehicleModels from './components/VehicleModels'
import Brands from './components/Brands'

export default [
    {
        path: '/',
        component: Vehicles
    },
    {
        path: '/modeller',
        component: VehicleModels
    },
    {
        path: '/merker',
        component: Brands
    },
    {
        path: '/rediger',
        component: Edit
    },
]