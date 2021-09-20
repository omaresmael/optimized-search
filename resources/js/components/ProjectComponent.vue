<template>

    <div class="countries">
        <div class="filter">

            <input type="text" class="input" id="search" ref="key" @blur="search()" placeholder="Search keyword and then blur">
        </div>

        <table-component
            :columns="columns"
            :sortKey="sortKey"
            :sortOrders="sortOrders"
            @sort="sortBy"
        >
            <tbody v-for="user in users" :key="user.id">
                <td>{{user.first_name}}</td>
                <td>{{user.email }}</td>
                <td>{{user.company.name}}</td>

            </tbody>
        </table-component>

        <pagination-component
            :pagination="pagination"
            @prev="getUsers(pagination.prevPageUrl)"
            @next="getUsers(pagination.nextPageUrl)"
        ></pagination-component>
    </div>
</template>

<script>
    import TableComponent from './TableComponent.vue'
    import PaginationComponent from './PaginationComponent.vue'

    export default {
        components: {TableComponent,PaginationComponent},
        created() {

            this.getUsers();
        },
        data() {
            let sortOrders = {};

            let columns = [
                {width: '35%',label: 'Name', name: 'name'},
                {width: '35%',label: 'Email', name: 'email'},
                {width: '30%',label: 'Company', name: 'company'},

            ];
            columns.forEach((column) => {
                sortOrders[column.name] = -1;
            });

            return {
                users: [],
                columns: columns,
                sortKey: 'name',
                sortOrders: sortOrders,

                tableData: {
                    sync: 0,
                    length: 10,
                    search: '',
                    column: 0,
                    dir: 'asc',
                },
                pagination: {
                    nextPageUrl: '',
                    prevPageUrl: '',
                    currentPage: '',
                    lastPage: '',
                },
            }
        },

        methods: {
            search() {
                this.tableData.search = this.$refs.key.value;
                this.getUsers();
            },
            getUsers(url = '/users') {
                this.tableData.sync++;

                axios.get(url, {params: this.tableData})
                    .then(response => {
                        let data = response.data;
                        if (1) {
                            this.users = data.users.data;
                            console.log(data.users)
                            this.configPagination(data.users);
                        }
                    })
                    .catch(errors => {
                        console.log(errors);
                    });
            },
            configPagination(data) {
                this.pagination.nextPageUrl = data.next_page_url;
                this.pagination.prevPageUrl = data.prev_page_url;
                this.pagination.currentPage = data.current_page;
                this.pagination.lastPage = data.last_page;
            },
            sortBy(key) {
                this.sortKey = key;
                this.sortOrders[key] = this.sortOrders[key] * -1;
                console.log(key)
                this.tableData.column = this.getIndex(this.columns, 'name', key);
                this.tableData.dir = this.sortOrders[key] === 1 ? 'asc' : 'desc';

                this.getCountries();
            },
            getIndex(array, key, value) {
                return array.findIndex(i => i[key] === value)
            },

        },
    }
</script>

<style >

    body {
        margin: 0;
        box-sizing: border-box;
    }
    table {
        width: 100%;
    }
    .countries {
        margin: 5rem auto;
        width: 80%
    }
    .filter {
        width: 50%;
        display: flex;
        margin-bottom: 3rem;
    }
    .filter #search {
        margin-left: 1rem;
    }
    .sorting {
        background-image: url('/images/sort_both.png');
        background-repeat: no-repeat;
        background-position: center right;
    }
    .sorting_asc {
        background-image: url('/images/sort_asc.png');
        background-repeat: no-repeat;
        background-position: center right;
    }
    .sorting_desc {
        background-image: url('/images/sort_desc.png');
        background-repeat: no-repeat;
        background-position: center right;
    }

</style>
