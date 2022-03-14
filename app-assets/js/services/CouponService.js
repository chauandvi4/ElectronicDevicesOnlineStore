export class CouponService {
  static getAll(page, limit) {
    return Promise.all([
      axios.get(`/api.php/coupon/list?limit=${limit}&page=${page}`),
      axios.get(`/api.php/coupon/count`),
    ]).then(([resData, resCount]) => {
      return {
        rows: resData.data,
        totalRecords: resCount.data,
      };
    });
  }

  static getOne(id) {
    return axios.get(`/api.php/coupon/get_one?id=${id}`);
  }

  static create(data) {
    return axios.post("/api.php/coupon/create", data).then((res) => {
      Utils.showToastrSuccess("Create Coupon Successfully!");
      return res;
    });
  }

  static update(id, data) {
    return axios.put(`/api.php/coupon/update?id=${id}`, data).then((res) => {
      Utils.showToastrSuccess("Update Coupon Successfully!");
      return res;
    });
  }

  static delete(id) {
    return axios.delete(`/api.php/coupon/delete?id=${id}`).then((res) => {
      Utils.showToastrSuccess("Delete Coupon Successfully!");
      return res;
    });
  }
}
