<template>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <fieldset>
                    <legend>Filter</legend>
                    <p v-if="errors.length">
                        <ul>
                            <li v-for="error in errors">{{ error }}</li>
                        </ul>
                    </p>
                    <form>
                        <div class="form-row">
                            <div class="row">
                            <div class="col-md-4 mb-3">
                                <select class="form-control" name="hotel" @change="display()" v-model="selected">
                                    <option value="" selected disabled>Select Hotel</option>
                                    <option v-for="hotel in hotels" :key="hotel.id" v-bind:value="{ id: hotel.id }">
                                        {{ hotel.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <vuejs-datepicker
                                        wrapper-class="inline"
                                        placeholder="From date"
                                        format="yyyy-MM-dd"
                                        :clear-button="true"
                                        v-model='fromDate'
                                        @closed='display();'
                                        @cleared='display();'
                                ></vuejs-datepicker>
                            </div>
                            <div class="col-md-4 mb-3">
                                <vuejs-datepicker
                                        wrapper-class="inline"
                                        placeholder="To date"
                                        format="yyyy-MM-dd"
                                        :clear-button="true"
                                        v-model='toDate'
                                        :disabledDates="disabledDates"
                                        @closed='display();'
                                        @cleared='display();'
                                ></vuejs-datepicker>
                            </div>
                        </div>
                        </div>
                    </form>
                </fieldset>
                <div>
                    <LineChart/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import vuejsDatepicker from 'vuejs-datepicker';
    import axios from 'axios'
    import LineChart from './LineChart'

    export default {
        name: 'App',
        data() {
            return {
                selected: '',
                hotels: null,
                fromDate: null,
                toDate: null,
                errors: [],
                disabledDates: {
                    to: null
                }
            }
        },
        mounted() {
            axios.get('/hotels').then(response => {
                this.hotels = response.data.hotels;
            }).catch((err) => {
                this.errors.push(err.response.data.error);
            });
        },
        methods: {
            display() {
                // Get selected from and to date
                let fromDate = new Date(this.fromDate);
                let toDate = new Date(this.toDate);

                // Disabled to date after current selected from date
                this.disabledDates.to = fromDate;

                // Check from date is greater then to date
                if(fromDate.getTime() > toDate.getTime()) {
                    this.toDate = null;
                }

                // Process graph data
                if (this.fromDate && this.toDate && this.selected.id !== undefined) {
                    this.errors = [];

                    // Make request
                    let params = {
                        hotel: this.selected.id,
                        fromDate: this.fromDate.toISOString().substring(0, 10),
                        toDate: this.toDate.toISOString().substring(0, 10)
                    };

                    // Get graph data
                    let labels = [];
                    let dataset = [];
                    let reviews = [];
                    axios.get('/review', {params : params}).then(response => {
                        let graph = response.data.graph;
                        if (graph.length > 0) {
                            graph.forEach(function (item) {
                                labels.push(item.date_group);
                                dataset.push(item.average_score);
                                reviews.push(item.review_count);
                            });
                        } else {
                            this.errors.push('There is no data found for selected options.');
                        }

                        // Re render the graph
                        LineChart.methods.update(labels, dataset, reviews);

                    }).catch( (err) => {
                        this.errors.push(err.response.data.error);
                    });
                }

                // Setting errors
                this.errors = [];
                if (this.selected.id === undefined || this.selected.id === 'undefined') {
                    this.errors.push('Hotel name is required.');
                } else if (!this.fromDate) {
                    this.errors.push('From date is required.');
                } else if (!this.toDate) {
                    this.errors.push('To date is required.');
                }

                return true;
            }
        },
        components: {
            vuejsDatepicker,
            LineChart
        }
    }
</script>