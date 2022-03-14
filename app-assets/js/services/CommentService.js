export class CommentService {
  static getAll(page, limit) {
    return Promise.all([
      axios.get(`/api.php/comment/list?limit=${limit}&page=${page}`),
      axios.get(`/api.php/comment/count`),
    ]).then(([resData, resCount]) => {
      return {
        rows: resData.data,
        totalRecords: resCount.data,
      };
    });
  }

  static getOne(id) {
    return axios.get(`/api.php/comment/getOne?id=${id}`);
  }

  static create(data) {
    return axios.post("/api.php/comment/create", data).then((res) => {
      Utils.showToastrSuccess("Create comment Successfully!");
      return res.data;
    });
  }

  static update(id, data) {
    //console.log(id, data);
    return axios.put(`/api.php/comment/update?id=${id}`, data).then((res) => {
      Utils.showToastrSuccess("Update comment Successfully!");
      return res;
    });
  }

  static delete(id) {
    return axios.delete(`/api.php/comment/delete?id=${id}`).then((res) => {
      Utils.showToastrSuccess("Delete comment Successfully!");
      return res;
    });
  }

  static getComments(product_id) {
    return axios.get(`/api.php/comment/getComments?id=${product_id}`);
  }
}
