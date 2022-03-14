export class BlogService {
  static getAll(page, limit) {
    return Promise.all([
      axios.get(`/api.php/blog/list?limit=${limit}&page=${page}`),
      axios.get(`/api.php/blog/count`),
    ]).then(([resData, resCount]) => {
      return {
        rows: resData.data,
        totalRecords: resCount.data,
      };
    });
  }

  static getRecent(page, limit) {
    console.log("in get recent");
    return Promise.all([
      axios.get(`/api.php/blog/list_recent?limit=${limit}&page=${page}`),
    ]).then((resData) => {
      console.log("recent post in blog service");
      console.log(resData[0].data);
      return {
        rows: resData[0].data,
      };
    });
  }

  static getOne(id) {
    console.log("get blog");
    return axios.get(`/api.php/blog/get_one?id=${id}`);
  }

  static create(data) {
    console.log("create blog");
    console.log(data);
    return axios.post("/api.php/blog/create", data).then((res) => {
      Utils.showToastrSuccess("Create Blog Successfully!");
      return res;
    });
  }

  static update(id, data) {
    console.log("data update");
    console.log(data);
    return axios.put(`/api.php/blog/update?id=${id}`, data).then((res) => {
      Utils.showToastrSuccess("Update Blog Successfully!");
      return res;
    });
  }

  static delete(id) {
    return axios.delete(`/api.php/blog/delete?id=${id}`).then((res) => {
      Utils.showToastrSuccess("Delete Blog Successfully!");
      return res;
    });
  }

  static getListFilter(page, limit, title, topic_id) {
    let paramsObj = {
      limit: limit,
      page: page,
      topic_id: topic_id,
      title: title,
    };
    const searchParams = new URLSearchParams(paramsObj);
    console.log(searchParams);
    return Promise.all([
      axios.get(`/api.php/blog/list_filter?${searchParams.toString()}`),
      axios.get(`/api.php/blog/count_filter?${searchParams.toString()}`),
    ]).then(([resData, resCount]) => {
      console.log("Blog service");

      console.log(resData.data);
      console.log(resCount.data);

      return {
        rows: resData.data,
        totalRecords: resCount.data,
      };
    });
  }



  //Topic

  static getAllTopic(page, limit) {
    return Promise.all([
      axios.get(`/api.php/blog/list_topic?limit=${limit}&page=${page}`),
      axios.get(`/api.php/blog/count_topic`),
    ]).then(([resData, resCount]) => {
      console.log('in blogservice')
      console.log(resData.data)
      return {
        rows: resData.data,
        totalRecords: resCount.data,
      };
    });
  }


  static getOneTopic(id) {
    console.log("get blog");
    return axios.get(`/api.php/blog/get_one_topic?id=${id}`);
  }

  static createTopic(data) {
    console.log("create blog");
    console.log(data);
    return axios.post("/api.php/blog/create_topic", data).then((res) => {
      Utils.showToastrSuccess("Create Blog Successfully!");
      return res;
    });
  }

  static updateTopic(id, data) {
    console.log("data update");
    console.log(data);
    return axios.put(`/api.php/blog/update_topic?id=${id}`, data).then((res) => {
      Utils.showToastrSuccess("Update Blog Successfully!");
      return res;
    });
  }

  static deleteTopic(id) {
    return axios.delete(`/api.php/blog/delete_topic?id=${id}`).then((res) => {
      Utils.showToastrSuccess("Delete Blog Successfully!");
      return res;
    });
  }
}
