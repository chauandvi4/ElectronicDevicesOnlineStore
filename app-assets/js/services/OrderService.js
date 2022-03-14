export class OrderService {
  static getAll(page, limit) {
    return Promise.all([
      axios.get(`/api.php/order/list?limit=${limit}&page=${page}`),
      axios.get(`/api.php/order/count`),
    ]).then(([resData, resCount]) => {
      return {
        rows: resData.data,
        totalRecords: resCount.data,
      };
    });
  }

  static getOne(id) {
    return axios.get(`/api.php/order/get_one?id=${id}`);
  }

  static create(data) {
    return axios.post("/api.php/order/create", data).then((res) => res.data);
  }

  static update(id, data) {
    return axios.put(`/api.php/order/update?id=${id}`, data).then((res) => {
      Utils.showToastrSuccess("Update order Successfully!");
      return res;
    });
  }

  static delete(id) {
    return axios.delete(`/api.php/order/delete?id=${id}`).then((res) => {
      Utils.showToastrSuccess("Delete order Successfully!");
      return res;
    });
  }
}
