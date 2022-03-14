export class ShippingService {
  static getProvinces() {
    return axios.get(`/api.php/shipping/list_province`).then((res) =>
      res.data.data.sort((a, b) => {
        if (a.ProvinceName < b.ProvinceName) {
          return -1;
        }
        if (a.ProvinceName > b.ProvinceName) {
          return 1;
        }
        return 0;
      })
    );
  }

  static getDistricts(province_id) {
    return axios
      .get(`/api.php/shipping/list_district`, {
        params: {
          province_id,
        },
      })
      .then((res) => res.data.data)
      .then((data) =>
        data
          .filter((item) => {
            return (
              item.DistrictName !== "Quận Vật Tư HN" &&
              item.DistrictName !== "Quận Đặc Biệt"
            );
          })
          .sort((a, b) => {
            if (a.DistrictName < b.DistrictName) {
              return -1;
            }
            if (a.DistrictName > b.DistrictName) {
              return 1;
            }
            return 0;
          })
      );
  }

  static getWards(district_id) {
    return axios
      .get(`/api.php/shipping/list_ward`, {
        params: {
          district_id,
        },
      })
      .then((res) => res.data.data)
      .then((data) =>
        data.sort((a, b) => {
          if (a.WardName < b.WardName) {
            return -1;
          }
          if (a.WardName > b.WardName) {
            return 1;
          }
          return 0;
        })
      );
  }

  static getShippingService(params) {
    return axios
      .get(`/api.php/shipping/get_service`, {
        params,
      })
      .then((res) => res.data.data)
      .then((data) =>
        data.map((item) => {
          return {
            ...item,
            short_name: SHIPPING_SERVICE[item.service_id],
          };
        })
      );
  }

  static getShippingFee(params) {
    return axios
      .get(`/api.php/shipping/calculate_fee`, {
        params,
      })
      .then((res) => res.data.data);
  }

  static createShipping(order_id) {
    return axios
      .post("/api.php/shipping/create_order", { order_id })
      .then((res) => {
        Utils.showToastrSuccess("Create Ship Order Successfully!");
        return res;
      });
  }
}
