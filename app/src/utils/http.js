import axios from "axios";
import {store} from "@/utils/store";
import router from "@/router";
export default axios.create();

const config = {
    baseURL: process.env.VUE_APP_BACKEND_URL
}
const client = axios.create(config)
const authInterceptor = config => {
    config.headers.Authorization = "Bearer " + localStorage.getItem('auth_key')
    return config
}
let callsNum = 0
const loaderInterceptor = config => {
    callsNum++
    store.showLoader = true
    return config
}
client.interceptors.request.use(authInterceptor)
client.interceptors.request.use(loaderInterceptor)
client.interceptors.response.use(
    function (response) {
        callsNum--
        if (callsNum === 0) {
            store.showLoader = false
        }
        return response
    },
    function(error) {
        callsNum--
        if (callsNum === 0) {
            store.showLoader = false
        }
        if (error.response.status === 401) {
            router.push({name: 'Login'})
        }
        return error
    }
)
export const request = {
    call: (method, uri, data = {}, headers = {}) => {
        return client.request({
            method: method,
            url: uri,
            data: data,
            headers: headers
        })
    }
}