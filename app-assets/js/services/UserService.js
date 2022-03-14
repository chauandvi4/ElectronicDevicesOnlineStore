export class UserService {
  static getAll(page, limit) {
    return Promise.all([
      axios.get(`/api.php/user/list?limit=${limit}&page=${page}`),
      axios.get(`/api.php/user/count`),
    ]).then(([resData, resCount]) => {
      return {
        rows: resData.data,
        totalRecords: resCount.data,
      };
    });
  }

  static getOne(id) {
    return axios.get(`/api.php/user/getOne?id=${id}`);
  }

  static login(data) {
    return axios.post("/api.php/user/login", data).then((res) => {
      Utils.showToastrSuccess("Login Successfully!");
      Utils.setToken(res.data?.jwt);
      return res;
    });
  }

  static logout() {
    Utils.setToken("");
    Utils.showToastrSuccess("Logout Successfully!");
    setTimeout(() => {
      window.location.href = "/";
    }, 1000);
  }

  static register(data) {
    return axios.post("/api.php/user/register", data).then((res) => {
      Utils.showToastrSuccess("Register Successfully!");
      return res;
    });
  }

  static create(data) {
    return axios.post("/api.php/user/create", data).then((res) => {
      Utils.showToastrSuccess("Create User Successfully!");
      return res;
    });
  }

  static update(id, data) {
    return axios.put(`/api.php/user/update?id=${id}`, data).then((res) => {
      Utils.showToastrSuccess("Update User Successfully!");
      return res;
    });
  }

  static delete(id) {
    return axios.delete(`/api.php/user/delete?id=${id}`).then((res) => {
      Utils.showToastrSuccess("Delete User Successfully!");
      return res;
    });
  }

  static register(data) {
    return axios.post("/api.php/user/register", data).then((res) => {
      Utils.showToastrSuccess("Register User Successfully!");
      return res;
    });
  }

  static login(data) {
    return axios.post("/api.php/user/login", data).then((res) => {
      Utils.setToken(res.data?.jwt);
      Utils.showToastrSuccess(res.data.message);
      return res;
    });
  }

  static validate(data) {
    return axios.post("/api.php/user/validate", { jwt: data }).then((res) => {
      return res;
    });
  }

  static resetPass(data) {
    return axios.post("/api.php/user/resetPass", data).then((res) => {
      Utils.showToastrSuccess("Update Password Successfully");
      return res;
    });
  }

  static me(data) {
    return axios.get(`/api.php/user/me`);
  }

  static meUpdate(id, data) {
    return axios.put(`/api.php/user/meUpdate?id=${id}`, data).then((res) => {
      Utils.showToastrSuccess("Update User Successfully!");
      return res;
    });
  }
}
