export class ProductService {
  static getAll(page, limit) {
    return Promise.all([
      axios.get(`/api.php/product/list?limit=${limit}&page=${page}`),
      axios.get(`/api.php/product/count`),
    ]).then(([resData, resCount]) => {
      return {
        rows: resData.data,
        totalRecords: resCount.data,
      };
    });
  }

  static getListFilter(page, limit, name, priceFrom, priceTo, category) {
    let paramsObj = {
      limit: limit,
      page: page,
      priceFrom: priceFrom,
      priceTo: priceTo,
      category: category,
      name: name,
    };
    const searchParams = new URLSearchParams(paramsObj);
    return Promise.all([
      axios.get(`/api.php/product/list_filter?${searchParams.toString()}`),
      axios.get(`/api.php/product/count_filter?${searchParams.toString()}`),
    ]).then(([resData, resCount]) => {
      return {
        rows: resData.data,
        totalRecords: resCount.data,
      };
    });
  }

  static getOne(id) {
    return axios.get(`/api.php/product/get_one?id=${id}`);
  }

  static create(data) {
    console.log(data);
    return axios.post("/api.php/product/create", data).then((res) => {
      Utils.showToastrSuccess("Create Product Successfully!");
      return res;
    });
  }

  static update(id, data) {
    return axios.put(`/api.php/product/update?id=${id}`, data).then((res) => {
      Utils.showToastrSuccess("Update Product Successfully!");
      return res;
    });
  }

  static delete(id) {
    return axios.delete(`/api.php/product/delete?id=${id}`).then((res) => {
      Utils.showToastrSuccess("Delete Product Successfully!");
      return res;
    });
  }
}
