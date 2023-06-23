import axios from 'axios'

const axiosIns = axios.create({
  // You can add your headers here
  // ================================
  baseURL: process.env.APP_URL+'/api/',
  // timeout: 1000,
  // headers: {'X-Custom-Header': 'foobar'}
})

export default axiosIns
