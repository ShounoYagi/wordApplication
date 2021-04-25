import axios from 'axios'

const debug = process.env.NODE_ENV !== 'production'

const onSuccess = (resp) => {
  if (debug) {
    console.log(' << ' + JSON.stringify(resp.data))
  }
  return Promise.resolve(resp.data)
}
const onError = () => {
  throw new Error('API error.')
}

// リクエストメソッド問わず同じ関数を用いる
// api処理はこれを使いまわす
const api = (config) => {
    if (debug) {
        console.log(`${config.method} ${config.url} >> ${config.params}`);
    }
    return axios(config)
        .then(onSuccess)
        .catch(onError);
};

export default api;