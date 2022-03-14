export class WishlistService {
  static userId = 9;

  static getAll(page = 1, limit = 1000) {
    return axios
      .get(`/api.php/wishlist/list`, {
        params: {
          limit: limit,
          page: page,
          user_id: this.userId,
        },
      })
      .then((resData) => {
        return {
          rows: resData.data,
        };
      });
  }

  static getWishlistProduct(page, limit) {
    let paramsObj = {
      limit: limit,
      page: page,
      user_id: this.userId,
    };
    const searchParams = new URLSearchParams(paramsObj);

    return axios.get(
      `/api.php/wishlist/product_list?${searchParams.toString()}`
    );
  }

  static getAllCount() {
    return axios.get(`/api.php/wishlist/count?user_id=${this.userId}`);
  }

  static getOneWishlist(productId) {
    let paramsObj = {
      product_id: productId,
      user_id: this.userId,
    };
    const searchParams = new URLSearchParams(paramsObj);
    return axios.get(`/api.php/wishlist/get_one?${searchParams.toString()}`);
  }

  static addToWishlist(productId) {
    return this.getOneWishlist(productId).then((res) => {
      if (res.data && Object.keys(res.data).length) {
        return this.removeFromWishlist(productId);
      } else {
        return axios
          .post(`/api.php/wishlist/add`, {
            product_id: productId,
            user_id: this.userId,
          })
          .then((res) => {
            Utils.showToastrSuccess("Product added to wishlist successfully!");
            return res;
          })
          .finally(() => {
            Utils.refetchWishlist();
          });
      }
    });
  }

  static removeFromWishlist(productId) {
    let paramsObj = {
      product_id: productId,
      user_id: this.userId,
    };
    const searchParams = new URLSearchParams(paramsObj);
    return axios
      .delete(`/api.php/wishlist/delete?${searchParams.toString()}`)
      .then((res) => {
        Utils.showToastrSuccess("Product has been removed from wishlist!");
        return res;
      })
      .finally(() => {
        Utils.refetchWishlist();
      });
  }
}
