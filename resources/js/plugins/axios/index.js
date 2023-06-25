import axios from 'axios'

const axiosIns = axios.create({
  baseURL: import.meta.env.VITE_BASE_API_URL,
})

export default axiosIns
