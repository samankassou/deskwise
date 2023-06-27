import axios from 'axios'

const axiosIns = axios.create({
  baseURL: import.meta.env.VITE_BASE_API_URL,
  //baseURL: "https://deskwise.fly.dev/api/",
})

export default axiosIns
