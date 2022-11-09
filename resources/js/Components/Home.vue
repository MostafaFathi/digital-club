<template>

    <div>
        <!-- Page header -->
        <div class="page-header page-header-light">
            <div class="page-header-content header-elements-md-inline">
                <div class="page-title d-flex">
                    <h4><span class="font-weight-semibold">الاحصائيات</span></h4>
                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>


            </div>

            <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                <div class="d-flex">
                    <div class="breadcrumb">
                        <a href="/admin" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> الرئيسية</a>
                        <span class="breadcrumb-item active">الاحصائيات</span>
                    </div>

                    <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
                </div>

                <div class="header-elements">
                    <div class="breadcrumb justify-content-center">

                    </div>
                </div>
            </div>
        </div>
        <!-- /page header -->
        <div class="content">

            <div class="row">


                <div class="col-sm-12 col-xl-12">
                    <div class="card">
                        <div class="card-header header-elements-inline">
                            <h6 class="card-title">Last 10 members </h6>

                        </div>

                        <div class="table-responsive">
                            <table class="table text-nowrap">
                                <thead>
                                <tr>

                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Postal address</th>
                                    <th scope="col">Profession</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(item,index) in items">
                                    <td>{{ item.full_name }}</td>
                                    <td>{{ item.email }}</td>
                                    <td>{{ item.postal_address }}</td>
                                    <td>{{ item.profession }}</td>
                                </tr>
                                <tr v-if="!items.length">
                                    <td colspan="4" style="text-align: center">No members yet</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>


</template>

<script>
import ApexCharts from 'apexcharts'

export default {
    name: "Home",
    components: {
        apex: ApexCharts
    },
    data() {
        return {
            items: [],
            search_value: null,
            event_id: null,
        }
    },


    mounted() {
        this.get_members();
    },
    methods: {
        get_members(page = 1) {
            axios.get('/vue/admin/member?q=' + this.search_value + '&limit=' + 10 + '&page=' + page).then((response) => {
                this.items = response.data.data;
                this.events = response.data.events;
            })
        }
    }

}
</script>


<style>
.apexcharts-legend-text {
    margin-right: 10px;
}

.apexcharts-legend-marker {
    display: none !important;
}
</style>
