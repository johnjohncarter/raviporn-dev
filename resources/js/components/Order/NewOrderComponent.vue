<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Order New Create</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form role="form">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h4>กำหนดรายละเอียดสินค้า</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="order_date">กำหนดวันส่ง</label>
                            <input type="date"
                                   v-model="orders.order_date"
                                   class="form-control"
                                   id="order_date"
                                   placeholder="กำหนดวันส่ง">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="order_time">กำหนดวันเวลาส่ง</label>
                            <input type="time"
                                   v-model="orders.order_time"
                                   class="form-control"
                                   id="order_time"
                                   placeholder="กำหนดวันเวลาส่ง">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="description">รายละเอียดเพิ่มเติม</label>
                            <textarea type="text"
                                      v-model="orders.description"
                                      class="form-control"
                                      id="description"
                                      placeholder="รายละเอียดเพิ่มเติม"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h4>กำหนดสินค้า</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label>Select Customer</label>
                            <select class="form-control" name="user_id" v-on:change="getProduct()" v-model="user_id">
                                <option value="">select customer</option>
                                <option v-for="customer in customers" :value="customer['id']">
                                    {{ customer['name'] }} {{ customer['surname'] }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div v-for="(product, index) in products" :key="index" class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="order_date">ชื่อสินค้า : </label>
                                    <span>{{ product['name'] }}</span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="order_date">ราคา : </label>
                                    <span v-if="product['price']">{{ product['price']['price'] }} บาท</span>
                                    <span v-if="!product['price']"> - บาท</span>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label>จำนวนที่สั่ง</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="number"
                                           v-if="!product['price']"
                                           class="form-control"
                                           disabled
                                           placeholder="จำนวนที่สั่ง">
                                    <input type="number"
                                           v-if="product['price']"
                                           v-model="product.price_input"
                                           class="form-control"
                                           placeholder="จำนวนที่สั่ง">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="button" v-on:click="onSubmitNewOrder()" class="btn btn-primary">Submit</button>
                </div>
            </div>
            <!-- /.card-body -->
        </form>

    </div>
</template>

<script>
    export default {
        data() {
            return {
                host_with_api: location.origin + '/api/',
                products: [],
                current_product: [],
                customers: [],
                current_customer: {},
                user_id: '',
                orders: {},
            }
        },
        created() {
            this.getCustomer();
        },
        methods: {
            setFormProduct: function () {
                let current_product = [];
                let total_amount = 0;
                let total_price = 0;
                for (let index = 0; index < this.products.length; index++) {
                    if (this.products[index]['price_input']) {
                        let current_data = {};
                        current_data['id'] = this.products[index]['id'];
                        current_data['amount'] = parseFloat(this.products[index]['price_input']);
                        current_data['price'] = (parseFloat(this.products[index]['price_input']) * parseFloat(this.products[index]['price']['price']));
                        (total_amount += current_data['amount']);
                        (total_price += current_data['price']);
                        current_product.push(current_data);
                    }
                }
                return { products: current_product, total_amount: total_amount, total_price: total_price };
            },
            getCustomer: function () {
                axios.get(this.host_with_api + 'customer').then(
                    response => {
                        if (response.data.success) {
                            this.customers = response.data.data;
                        }
                    },
                    error => {
                        console.log(error)
                    }
                );
            },
            getCustomerById: function () {
                axios.get(this.host_with_api + 'customer/' + this.user_id).then(
                    response => {
                        if (response.data.success) {
                            this.current_customer = response.data.data;
                        }
                    },
                    error => {
                        console.log(error)
                    }
                );
            },
            getProduct: function () {
                if (!this.user_id) {
                    this.products = [];
                }
                axios.get(this.host_with_api + 'product?user_id=' + this.user_id).then(
                    response => {
                        if (response.data.success) {
                            this.products = response.data.data;
                        }
                    },
                    error => {
                        console.log(error)
                    }
                );
            },
            onSubmitNewOrder: function () {
                const current_data = this.setFormProduct();
                let data = {};
                data['user_id'] = this.user_id;
                data['order_date'] = this.orders.order_date;
                data['order_time'] = this.orders.order_time;
                data['description'] = this.orders.description;
                data['total_amount'] = current_data['total_amount'];
                data['total_price'] = current_data['total_price'];
                data['products'] = current_data['products'];
                axios.post(this.host_with_api + 'order', data).then(
                    response => {
                        if (response.data.success) {
                            this.$swal("Good job!", "You clicked the button!", "success")
                                .then((value) => {
                                    if (value) {
                                        location.href = 'order-new';
                                    }
                                });
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
