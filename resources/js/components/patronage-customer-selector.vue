<template>
    <label class="mb-2 ml-1 font-bold text-xs text-slate-700">Show patronage only to following customers:</label>
    <div class="mb-4">
        <fieldset class="border mr-4 rounded p-4 h-32 overflow-auto">
            <legend class="px-2">Selected customers</legend>
            <div v-for="(customer, cust_index) in selected_customers">
                <label class="mb-2">
                    <button class="inline-block px-3 py-2 mb-0 font-bold text-center text-black uppercase transition-all ease-in bg-white border-0 border-white rounded-lg shadow-soft-md bg-150 leading-pro text-xs hover:shadow-soft-2xl hover:scale-102" @click.prevent="removeCustomer(cust_index)">-</button>
                    <input type="hidden" name="customer_ids[]" :value="customer.id">
                    {{customer.user.name}} / {{customer.user.email}}
                </label>
            </div>
        </fieldset>
    </div>
    <div><input class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" type="text" placeholder="Search customers" v-model="search"></div>
    <div class="mb-4">
        <div>
              <label class="mb-2">
                <input type="checkbox" @change="selectAllCustomers($event)">
                Select All
              </label>
            </div>
        <fieldset class="border mr-4 rounded p-4 h-32 overflow-auto">
            
            
            <legend class="px-2">Available customers</legend>
            
            <div v-for="customer in filtered_customers">
                <label class="mb-2">
                    <button class="inline-block px-3 py-2 mb-0 font-bold text-center text-black uppercase transition-all ease-in bg-white border-0 border-white rounded-lg shadow-soft-md bg-150 leading-pro text-xs hover:shadow-soft-2xl hover:scale-102" @click.prevent="addCustomer(customer)">+</button>
                    {{customer.user.name}} / {{customer.user.email}}
                </label>
            </div>
        </fieldset>
    </div>
</template>
<script>
    import axios from 'axios'
    export default {
        name: 'patro-custo-selector',
        props: {
            customer_ids: {
                type: Array
            },

        },
        data(){
            return {
                selected_customers: [],
                customers: [],
                search: '',

            }
        },
        mounted(){
            this.load()

        },
        watch:{
            search(){
                this.load()
            }
        },
        computed: {
            filtered_customers(){
                return this.customers.filter(customer=>{
                    return !this.selected_customers.map(selected=>selected.id).includes(customer.id)
                })
            }
        },
        methods: {
            removeCustomer(index){
                this.selected_customers.splice(index, 1)
            },
            addCustomer(customer){
                if (!this.selected_customers.includes(customer)) {
                this.selected_customers.push(customer);
                // Additional logic for adding the customer
            }
            },  
            selectAllExceptSome(event) {
            if (event.target.checked) {
                // Clear the selected_customers array
                this.selected_customers = [];
                // Add customers except some to selected_customers
                this.filtered_customers.forEach(customer => {
                    // Add the customer if it's not in the exclusion list
                    if (!this.excluded_customers.includes(customer)) {
                        this.selected_customers.push(customer);
                    }
                });
            } else {
                // Clear selected_customers array
                this.selected_customers = [];
            }
            },
             selectAllCustomers(event) {
             if (event.target.checked) {
                // Add all customers to selected_customers
                this.filtered_customers.forEach(customer => {
                    if (!this.selected_customers.includes(customer)) {
                        this.selected_customers.push(customer);
                    }
                });
             } else {
                // Clear all customers from selected_customers
                this.selected_customers = [];
             }
            },
            load(){
                axios.get('/json/customers?ss='+this.search).then(response=>{
                    this.customers = response.data
                    if(this.customer_ids){
                        this.customers.forEach(customer=>{
                            if(this.customer_ids.includes(customer.id.toFixed(0))){
                                this.addCustomer(customer)
                            }
                        })
                    }
                })
            }
        }
    }
</script>