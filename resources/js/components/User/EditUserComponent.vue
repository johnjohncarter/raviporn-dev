<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit User</h3>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="username">username<span class="text-red">*</span></label>
                            <input type="text"
                                   class="form-control"
                                   id="username"
                                   name="username"
                                   v-model="user.username"
                                   :class="errors.email ? 'is-invalid': ''"
                                   placeholder="Enter username">
                            <span v-if="errors.username" v-for="error in errors.username" class="text-red" style="font-size: 80%">
                                {{ error }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">name<span class="text-red">*</span></label>
                            <input type="text"
                                   class="form-control"
                                   id="name"
                                   name="name"
                                   v-model="user.name"
                                   :class="errors.name ? 'is-invalid': ''"
                                   placeholder="Enter name">
                            <span v-if="errors.name" v-for="error in errors.name" class="text-red" style="font-size: 80%">
                                {{ error }}
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="surname">surname<span class="text-red">*</span></label>
                            <input type="text"
                                   class="form-control"
                                   id="surname"
                                   name="surname"
                                   v-model="user.surname"
                                   :class="errors.surname ? 'is-invalid': ''"
                                   placeholder="Enter surname">
                            <span v-if="errors.surname"
                                  v-for="error in errors.surname"
                                  class="text-red"
                                  style="font-size: 80%">
                                {{ error }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="email"
                                   class="form-control"
                                   id="email"
                                   name="email"
                                   v-model="user.email"
                                   :class="errors.email ? 'is-invalid': ''"
                                   placeholder="Enter email">
                            <span v-if="errors.email"
                                  v-for="error in errors.email"
                                  class="text-red"
                                  style="font-size: 80%">
                                {{ error }}
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="phone">phone</label>
                            <input type="text"
                                   class="form-control"
                                   id="phone"
                                   name="phone"
                                   v-model="user.phone"
                                   placeholder="Enter phone">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="facebook">facebook</label>
                            <input type="text"
                                   class="form-control"
                                   id="facebook"
                                   name="facebook"
                                   v-model="user.facebook"
                                   placeholder="Enter facebook">

                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="line">line</label>
                            <input type="text"
                                   class="form-control"
                                   id="line"
                                   name="line"
                                   v-model="user.line"
                                   placeholder="Enter line">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="role">role</label>

                            <select class="form-control"
                                    id="role" name="role_id"
                                    v-model="user.role_id"
                                    :class="errors.role_id ? 'is-invalid': ''"
                                    v-on:change="onSelectRole()">
                                <option value="">เลือกบทบาทู้ใช้งาน</option>
                                <option v-for="role in roles" :value="role.id" >
                                    {{ role.name }} {{ role.description }}
                                </option>
                            </select>
                            <span v-if="errors.role_id"
                                  v-for="error in errors.role_id"
                                  class="text-red"
                                  style="font-size: 80%">
                                {{ error }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row" v-if="products.length">
                    <div class="col-sm-12">
                        <h4>กำหนดราคาสินค้า</h4>
                    </div>
                </div>
                <div class="row" v-if="products.length">
                    <div class="col-lg-8">
                        <div v-for="(product, index) in products" :key="index" class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>ชื่อสินค้า : </label>
                                    <span>{{ product['name'] }}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <span>{{ product['description'] }}</span>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="number"
                                           v-model="product.price_input"
                                           class="form-control"
                                           placeholder="ใสราคาสินค้า">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding-bottom: 50px">
                    <div class="col-sm-12 text-right">
                        <button type="button"
                                v-on:click="onSubmitUpdateUser()"
                                class="btn btn-success">submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                host_with_api: location.origin + '/api/',
                roles: [],
                user: {},
                products: {},
                current_product: [],
                customers: [],
                current_customer: {},
                user_id: '',
                orders: {},
                errors: {},
            }
        },
        created() {
            this.getRoles();
            this.user.role = '';
            let base_url = window.location.href.split('/');
            this.user_id = base_url[4];
            this.getCurrentUser();
        },
        methods: {
            getCurrentUser: function() {
                axios.get(this.host_with_api + 'users/' + this.user_id).then(
                    response => {
                        if (response.data.success) {
                            this.user = response.data.data;
                            if (this.user.role_id == 3) {
                                this.getProduct();
                            }
                        }
                    },
                    error => {
                        console.log(error)
                    }
                );
            },
            getRoles: function () {
                axios.get(this.host_with_api + 'roles').then(
                    response => {
                        if (response.data.success) {
                            this.roles = response.data.data;
                        }
                    },
                    error => {
                        console.log(error)
                    }
                );
            },
            getProduct: function () {
                axios.get(this.host_with_api + 'product?user_id=' + this.user_id).then(
                    response => {
                        if (response.data.success) {
                            this.products = response.data.data;
                            for(let index = 0; index < this.products.length; index++) {
                                if (this.products[index]['price']) {
                                    this.products[index].price_input = this.products[index]['price']['price']
                                }
                            }
                        }
                    },
                    error => {
                        console.log(error)
                    }
                );
            },
            onSubmitUpdateUser: function () {
                axios.put(this.host_with_api + 'users/' + this.user_id, this.user).then(
                    response => {
                        if (response.data.success) {
                            if (this.user.role_id == 3) {
                                this.onSubmitProductPrice(response.data.data.id);
                            } else {
                                this.$swal("Success !!", "create new user successfully", "success")
                                    .then((value) => {
                                        if (value) {
                                            window.location.href = '/manage-user';
                                        }
                                    });
                            }
                        } else {
                            this.errors = response.data.errors;
                        }
                    },
                    error => {
                        console.log(error)
                    }
                );
            },
            onSelectRole: function () {
                this.products = {};
                if (this.user.role_id === 3) {
                    this.getProduct();
                }
            },
            onSubmitProductPrice: function (user_id) {
                axios.put(this.host_with_api + 'product-price/' + user_id, { products: this.products }).then(
                    response => {
                        if (response.data.success) {
                            this.$swal("Success !!", "create new user successfully", "success")
                                .then((value) => {
                                    if (value) {
                                        window.location.href = '/manage-user';
                                    }
                                });
                        } else {
                            this.errors = response.data.errors;
                        }
                    },
                    error => {
                        console.log(error)
                    }
                );
            }
        },
    }
</script>
