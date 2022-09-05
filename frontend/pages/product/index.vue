<template>
  <b-container fluid="md" class="mt-5 mb-5">
    <Default/>
    <b-row>
      <b-col md="12">
        <b-card class="shadow-md border-0 rounded-lg">
          <h5>Products</h5>
          <hr>
          <!-- <b-button :to="{name: 'post-create'}" variant="primary" class="mb-3">TAMBAH</b-button> -->
          
          <b-table striped bordered hover responsive :items="products" :fields="fields" show-empty></b-table>
        </b-card>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import Default from '../../components/Default.vue'
  export default {
    data() {
        return {
            //header table  
            fields: ["name", "detail", "price", "unit"],
            //employees data
            products: [],
        };
    },
    mounted() {
        //fething ke Rest API 
        this.$axios.get("/product")
            .then(response => {
            //assign response ke state "products"
            this.products = response.data.products;
        })
            .catch(error => {
            console.log(error.response.data);
        });
    },
    components: { Default }
}
</script>

<style>

</style>