<template>
    <table class="table is-bordered data-table">
        <thead>
        <tr>
            <th v-for="column in columns" :key="column.name" @click="$emit('sort', column.name)"
                :class="sortKey === column.name ? (sortOrders[column.name] > 0 ? 'sorting_asc' : 'sorting_desc') : 'sorting'"
                :style="'width:'+column.width+';'+'cursor:pointer;'">
                {{column.label}}
            </th>
        </tr>
        </thead>
        <slot></slot>
    </table>
</template>

<script>

    export default {
        props: ['columns','sortKey','sortDirection','sortOrders'],
        mounted() {

        }
    }

</script>
<!--<template>-->
<!--    <vuetable ref="vuetable"-->
<!--              :fields="fields"-->
<!--              api-url="http://127.0.0.1:8000/countries"-->
<!--              data-path=""-->
<!--              pagination-path=""-->
<!--    ></vuetable>-->
<!--</template>-->

<!--<script>-->
<!--    import Vuetable from 'vuetable-2'-->

<!--    export default {-->
<!--        components: {-->
<!--            Vuetable-->
<!--        },-->
<!--        data() {-->
<!--            return {-->
<!--                fields: [-->
<!--                    {-->
<!--                        name: 'country',-->
<!--                        title: 'Country',-->
<!--                        sortField: 'country'-->
<!--                    },-->
<!--                    {-->
<!--                        name: 'state',-->
<!--                        title: 'State',-->
<!--                        sortField: 'state',-->
<!--                        formatter (value) {-->
<!--                            return value === '0' ? 'NOK' : 'OK'-->
<!--                        }-->

<!--                    },-->
<!--                    {-->
<!--                        name: 'country_code',-->
<!--                        title: 'Country Code',-->
<!--                    },-->
<!--                    {-->
<!--                        name: 'phone_number',-->
<!--                        title: 'Phone Num',-->

<!--                    },-->
<!--                ]-->
<!--            }-->
<!--        },-->

<!--        methods: {-->

<!--        }-->
<!--    }-->
<!--</script>-->
