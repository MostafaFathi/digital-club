<template>
    <div>
        <div id="map" :ref="'map'" class="h-500"></div>
    </div>
</template>
<script>
// import * as fs from 'fs-web';
// const fs = require('fs');
// const kmlString = fs.readFileSync("../assets/kml.kml");

export default {
    props: {},
    data() {
        return {
            latitude: '', longitude: '', zoom: '',
            work_area: {},
            districts: [],
            theme: 'light',
            landscape: '#ededed',//ededed
            geometryFill: '#ffffff',//
            roadHighway: '#cacaca',
            labelTextFill: '#444444',
            geoXml: '',
            geoJson: [],
            markers: [],
            districts_geo_array: [],
            icons: {
                active: {
                    icon: '/images/marker-selected.gif',
                },
                inactive: {
                    icon: '/images/marker-unselected-light2.png',
                }
            }

        }
    },
    mounted() {

        this.init_map()

        // this.load_kml ()


    },

    created() {

        let that = this
        this.$root.$on('load_work_area', (area) => {
            this.work_area = area
            this.load_work_area_districts()

        })

        this.$root.$on('load_all_districts', (districts) => {
            this.districts = districts
            this.load_all_districts(districts)

        })
    },
    methods: {

        async load_work_area_districts() {
            await this.$map

            // this.clear_map()

            var doc = this.work_area.districts
            for (var i = 0; i < doc.length; i++) {
                let geo_array = []

                let splitted = doc[i].shape.split(' ')

                for (var j = 0; j < splitted.length; j++) {

                    let split_2 = splitted[j].split(',')
                    let latlng = {
                        lng: parseFloat(split_2[0]),
                        lat: parseFloat(split_2[1])
                    }
                    if (split_2[0] == '' || (split_2[1]) == '') continue

                    geo_array.push(latlng)

                }

                let polygon = new google.maps.Polygon({
                    paths: geo_array,
                    strokeColor: '#3f84ee',
                    strokeOpacity: 1,
                    strokeWeight: 1,
                    fillColor: '#55e0e5',
                    fillOpacity: 0.35,
                    indexID: i,
                })
                this.geoJson.push(polygon)


                let that = this
                google.maps.event.addListener(polygon, 'click', function (event) {
                    //polygon.setOptions({fillColor:'#e3e3e3'})
                    // that.$router.push('/district_projects/' + polygon.indexID + '/' + backRouter[0] + '/' + backRouter[1])
                })



                polygon.setMap(this.$map)
                if(this.work_area.driver) {
                    google.maps.Polygon.prototype.my_getBounds = function () {
                        var bounds = new google.maps.LatLngBounds()
                        this.getPath().forEach(function (element, index) {
                            bounds.extend(element)
                        })
                        return bounds
                    }

                    var center = polygon.my_getBounds().getCenter()

                    var icon = {
                        url: "/website/images/car.svg",
                        scaledSize: new google.maps.Size(30, 30),
                    };

                    var marker = new google.maps.Marker({
                        position: center,
                        title: this.work_area.driver.user.name,
                        icon: icon
                    });
                    marker.setMap(this.$map)
                }


            }


        },

        async load_all_districts() {
            await this.$map

            // this.clear_map()

            let doc = this.districts
            for (var i = 0; i < doc.length; i++) {
                let geo_array = []

                let splitted = doc[i].shape.split(' ')

                for (var j = 0; j < splitted.length; j++) {

                    let split_2 = splitted[j].split(',')
                    let latlng = {
                        lng: parseFloat(split_2[0]),
                        lat: parseFloat(split_2[1])
                    }
                    if (split_2[0] == '' || (split_2[1]) == '') continue

                    geo_array.push(latlng)

                }

                let polygon = new google.maps.Polygon({
                    paths: geo_array,
                    strokeColor: '#3f84ee',
                    strokeOpacity: 1,
                    strokeWeight: 1,
                    fillColor: '#e3e3e3',
                    fillOpacity: 0.25,
                    indexID: i,
                })
                this.geoJson.push(polygon)


                let that = this
                google.maps.event.addListener(polygon, 'click', function (event) {

                    let index = that.work_area.districts.findIndex(item => item.id === that.districts[polygon.indexID].id);

                    console.log(index)

                    if (index === -1) {
                        polygon.setOptions({fillColor: '#55e557'})
                        that.work_area.districts.push(that.districts[polygon.indexID])

                    } else {
                        polygon.setOptions({fillColor: '#9d0126'})
                        that.$delete(that.work_area.districts, index)

                    }


                })

                polygon.setMap(this.$map)

            }


        },

        switch_markers_icons(type) {

            this.icons.active.icon = '/images/marker-selected.gif'
            this.icons.inactive.icon = '/images/marker-unselected-' + type + '2.png'
            if (this.$route.name != 'projects')
                this.load_markers(null, null)
        },
        slowPanTo(map, endPosition, n_intervals, T_msec, zoom) {

            var f_timeout, getStep, i, j, lat_array, lat_delta, lat_step, lng_array, lng_delta, lng_step, pan, ref,
                startPosition
            getStep = function (delta) {
                return parseFloat(delta) / n_intervals
            }
            startPosition = map.getCenter()
            lat_delta = endPosition.lat() - startPosition.lat()
            lng_delta = endPosition.lng() - startPosition.lng()
            lat_step = getStep(lat_delta)
            lng_step = getStep(lng_delta)
            lat_array = []
            lng_array = []
            for (i = j = 1, ref = n_intervals; j <= ref; i = j += +1) {
                lat_array.push(map.getCenter().lat() + i * lat_step)
                lng_array.push(map.getCenter().lng() + i * lng_step)
            }
            f_timeout = function (i, i_min, i_max) {
                return parseFloat(T_msec) / n_intervals
            }
            pan = function (i) {
                if (i < lat_array.length) {
                    return setTimeout(function () {
                        map.panTo(new google.maps.LatLng({
                            lat: lat_array[i],
                            lng: lng_array[i]
                        }))
                        map.setZoom(zoom)
                        return pan(i + 1)
                    }, f_timeout(i, 0, lat_array.length - 1))
                }
            }
            return pan(0)

        },
        set_map_dark(type) {
            if (type === 'dark') {
                this.color = '#1b1b1b'
                this.level_1 = 3
                this.level_2 = 10
                this.level_3 = 15
                this.level_4 = 40
                this.level_5 = 60
                this.level_6 = -100
            } else {
                this.color = '#ededed'
                this.level_1 = -3
                this.level_2 = -10
                this.level_3 = -15
                this.level_4 = -40
                this.level_5 = -60
                this.level_6 = 100
            }
            this.$map.mapTypes.set('styled_map', this.getMapStyles())
            this.$map.setMapTypeId('styled_map')
        }
        ,

        async load_near_projects(geo_array, district, action) {
            await this.$map
            this.clear_map()
            this.geoJson = [];
            const polygon = new google.maps.Polygon({
                paths: geo_array,
                strokeColor: '#3f84ee',
                strokeOpacity: 0.5,
                strokeWeight: 1,
                fillColor: '#55e0e5',
                fillOpacity: 0.35,
            })

            polygon.setMap(this.$map)
            this.geoJson.push(polygon)
            let center = this.getProjectCenter(geo_array)

            let projects = this.$root.data_src

            let near_projects = []

            for (var i = 0; i < projects.length; i++) {
                let geo_array = []

                let splitted = projects[i].shape.split(' ')

                for (var j = 0; j < splitted.length; j++) {

                    let split_2 = splitted[j].split(',')
                    let latlng = {
                        lng: parseFloat(split_2[0]),
                        lat: parseFloat(split_2[1])
                    }
                    if (split_2[0] == '' || (split_2[1]) == '') continue

                    geo_array.push(latlng)

                }
                let pcenter = this.getProjectCenter(geo_array)

                let dist = this.calc_distance(center, pcenter)

                if (dist < 5) {
                    this.load_project(projects[i], false)
                    near_projects.push(projects[i])
                }

            }

            window.near_projects = near_projects
            window.district = district
            if (action) {
                // this.$router.back();
                // router.push('/district_projects/' + district.id + '/home/نظرة عامة').catch(()=>{});

                this.$router.replace({
                    name: 'district_projects',
                    key: district.id,
                    params: {
                        id: district.id,
                        back_router: 'home',
                        back_router_text: 'نظرة عامة',
                    }
                })

                this.pan_to(center.lat(), center.lng(), 17)
            }

        },
        async load_category(category, backRouter) {
            await this.$map

            this.clear_map()

            var doc = this.$root.data_src
            for (var i = 0; i < doc.length; i++) {
                let geo_array = []

                let splitted = doc[i].shape.split(' ')

                for (var j = 0; j < splitted.length; j++) {

                    let split_2 = splitted[j].split(',')

                    if (split_2[0] == '' || (split_2[1]) == '') continue

                    let latlng = {
                        lng: parseFloat(split_2[0]),
                        lat: parseFloat(split_2[1])
                    }

                    geo_array.push(latlng)

                }
                if ((doc[i]['typology_en'] === category || category === 'all') && doc[i]['hidden'] !== 'Yes') {
                    let polygon = null
                    if (doc[i]['typology_en'] === 'Main Roads') {

                        polygon = new google.maps.Polyline({
                            path: geo_array,
                            geodesic: true,
                            strokeColor: '#47944e',
                            strokeOpacity: 1.0,
                            strokeWeight: 3,
                            indexID: i,
                        })
                    } else {
                        polygon = new google.maps.Polygon({
                            paths: geo_array,
                            strokeColor: '#47944e',
                            strokeOpacity: 1,
                            strokeWeight: 1,
                            fillColor: '#61d76c',
                            fillOpacity: 0.35,
                            indexID: i,
                        })
                    }
                    this.geoJson.push(polygon)

                    polygon.setMap(this.$map)
                    let that = this
                    google.maps.event.addListener(polygon, 'click', function (event) {
                        that.$router.push('/projects/' + polygon.indexID + '/' + backRouter[0] + '/' + backRouter[1])
                    })
                }

            }
            this.pan_to(this.latitude, this.longitude, this.zoom)

        },
        async load_markers(category, backRouter) {

            await this.$map

            this.clear_map()
            let theme = this.theme
            this.icons.active.icon = '/images/marker-selected.gif'
            this.icons.inactive.icon = '/images/marker-unselected-' + theme + '2.png'
            this.markers = [];
            var doc = this.$root.data_src
            for (var i = 0; i < doc.length; i++) {
                let infowindow = new google.maps.InfoWindow()
                let geo_array = []

                let splitted = doc[i].shape.split(' ')

                for (var j = 0; j < splitted.length; j++) {

                    let split_2 = splitted[j].split(',')

                    if (split_2[0] == '' || (split_2[1]) == '') continue

                    let latlng = {
                        lng: parseFloat(split_2[0]),
                        lat: parseFloat(split_2[1])
                    }

                    geo_array.push(latlng)

                }
                let center = this.getProjectCenter(geo_array)
                let image = doc[i].images[0]
                let title = doc[i].name_ar
                let id = doc[i].id
                let typology_en = doc[i].typology_en
                let typology_ar = doc[i].typology_ar
                let activeIcon = {
                    url: window.location.origin + this.icons['active'].icon, // url
                    scaledSize: new google.maps.Size(40, 40), // scaled size
                    origin: new google.maps.Point(0, 0), // origin
                    anchor: new google.maps.Point(0, 0) // anchor
                };
                var inActiveIcon = {
                    url: window.location.origin + this.icons['inactive'].icon, // url
                    scaledSize: new google.maps.Size(40, 40), // scaled size
                    origin: new google.maps.Point(0, 0), // origin
                    anchor: new google.maps.Point(0, 0) // anchor
                };
                let marker = new google.maps.Marker({
                    position: center,
                    indexID: i,
                    icon: inActiveIcon,
                    title: title,

                })

                const contentString =
                    '<div class="marker-tool">' +
                    '<img class="marker-tool-img img-fluid" src="' + image + '" >' +
                    '<div id="bodyContent">' +
                    '<h4><b>' + title + '</b></h4>' +
                    '</div></div>'
                let that = this
                google.maps.event.addListener(marker, 'mouseover', (function (marker, contentString, infowindow) {
                    return function () {

                        infowindow.setContent(contentString)
                        marker.setIcon(activeIcon)
                        infowindow.open(that.$map, marker)
                    }
                })(marker, contentString, infowindow))
                google.maps.event.addListener(marker, 'click', (function () {
                    that.$router.push({
                        name: 'projects',
                        params: {id: id, back_router: typology_en, 'back_router_text': typology_ar}
                    })
                }))

                google.maps.event.addListener(marker, 'mouseout', (function () {
                    marker.setIcon(inActiveIcon)
                    infowindow.close()
                }))
                google.maps.event.addListener(marker, 'mouseenter', (function () {
                    marker.setIcon(activeIcon)
                }))

                google.maps.event.addListener(this.$map, 'click', (function () {
                    marker.setIcon(inActiveIcon)
                    infowindow.close()
                }))
                this.markers.push(marker)
                if (doc[i].hidden === "Yes") continue;
                marker.setMap(this.$map)
            }
            this.pan_to(this.latitude, this.longitude, this.zoom)

        },
        load_project_marker(index, toggle) {

            let activeIcon = {
                url: window.location.origin + this.icons['active'].icon, // url
                scaledSize: new google.maps.Size(40, 40), // scaled size
                origin: new google.maps.Point(0, 0), // origin
                anchor: new google.maps.Point(0, 0) // anchor
            };
            var inActiveIcon = {
                url: window.location.origin + this.icons['inactive'].icon, // url
                scaledSize: new google.maps.Size(40, 40), // scaled size
                origin: new google.maps.Point(0, 0), // origin
                anchor: new google.maps.Point(0, 0) // anchor
            };
            for (var j = 0; j < this.markers.length; j++) {
                if (index !== j) {
                    this.markers[j].setIcon(inActiveIcon);
                } else {

                    if (toggle) {
                        this.markers[index].setIcon(activeIcon);
                    } else {
                        this.markers[index].setIcon(inActiveIcon);
                    }
                }
                // google.maps.event.trigger(this.markers[j], 'mouseout')
            }
            if (toggle) {

                //   let that = this;
                //   setTimeout(function(){
                //     google.maps.event.trigger(that.markers[index], 'mouseenter')
                //   },1000)


                // google.maps.event.trigger(this.markers[index], 'mouseover')
                //this.pan_to(this.markers[index].position.lat(), this.markers[index].position.lng(), this.zoom)
            }
        },

        clear_map() {
            for (var i = 0; i < this.geoJson.length; i++) {
                this.geoJson[i].setMap(null)
            }
            for (var j = 0; j < this.markers.length; j++) {
                this.markers[j].setMap(null)
            }
        },

        calc_distance(mk1, mk2) {

            var R = 3958.8 // Radius of the Earth in miles
            var rlat1 = mk1.lat() * (Math.PI / 180) // Convert degrees to radians
            var rlat2 = mk2.lat() * (Math.PI / 180) // Convert degrees to radians
            var difflat = rlat2 - rlat1 // Radian difference (latitudes)
            var difflon = (mk2.lng() - mk1.lng()) * (Math.PI / 180) // Radian difference (longitudes)

            var d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat / 2) * Math.sin(difflat / 2) + Math.cos(rlat1) * Math.cos(rlat2) * Math.sin(difflon / 2) * Math.sin(difflon / 2)))
            return d
        },
        getProjectCenter(coords) {
            {
                var bounds = new google.maps.LatLngBounds()
                for (var i = 0; i < coords.length; i++) {
                    bounds.extend(new google.maps.LatLng(coords[i]['lat'], coords[i]['lng']))
                }
                return bounds.getCenter()
            }
        },
        async load_json() {
            await this.$map

            var doc = this.$root.districts_src

            window.districts = doc
//
            for (var i = 0; i < doc.length; i++) {
                let geo_array = []

                let splitted = doc[i].shape.split(' ')

                for (var j = 0; j < splitted.length; j++) {

                    let split_2 = splitted[j].split(',')
                    let latlng = {
                        lng: parseFloat(split_2[0]),
                        lat: parseFloat(split_2[1])
                    }
                    if (split_2[0] == '' || (split_2[1]) == '') continue

                    geo_array.push(latlng)

                }
                const polygon = new google.maps.Polygon({
                    paths: geo_array,
                    strokeColor: '#568cfc',
                    strokeOpacity: 0.5,
                    strokeWeight: 1,
                    fillColor: '#54f6fc',
                    fillOpacity: 0.35,
                })
                this.geoJson.push(polygon)

                // polygon.setMap(this.$map)

            }
            window.geoJson = this.geoJson

        },
        generateRgba(opacity) {
            var o = Math.round, r = Math.random, s = 255
            return 'rgba(' + o(r() * s) + ',' + o(r() * s) + ',' + o(r() * s) + ',' + opacity + ')'
        },

        init_map() {

            this.$map = new google.maps.Map(document.getElementById('map'), {
                // eslint-disable-next-line no-undef

                gestureHandling: 'greedy',
                zoomControl: true,
                zoomControlOptions: {
                    position: google.maps.ControlPosition.LeftFloor,
                },
                maxZoom: 15,
                center: new google.maps.LatLng(24.727040, 46.709814),
                zoom: 11,


                disableDefaultUI: true,

                restriction: {
                    latLngBounds: {
                        north: 26.02,
                        south: 24.02,
                        west: 46.00,
                        east: 47.40
                    }
                }

            })


        },

        set_zoom(zoom) {
            this.$map.setZoom(zoom)
        },
        pan_to(latitude, longitude, zoom) {
            // console.log(latitude, longitude)
            this.$map.panTo(new google.maps.LatLng(latitude, longitude))
            //  this.slowPanTo(this.$map,new google.maps.LatLng(latitude, longitude), 20, 500,zoom)
            this.$map.setZoom(zoom)
        },
        displayPlaceMarks(place_marks, zoom, center) {
            for (var i = 0; i < this.geoXml.docs[0].placemarks.length; i++) {
                this.geoXml.docs[0].placemarks[i].id = i
                this.geoXml.docs[0].placemarks[i].polygon.setMap(null)

                for (let j = 0; j < place_marks.length; j++) {
                    if (place_marks.length > 1) {
                        this.set_zoom(10)
                    }
                    if (this.geoXml.docs[0].placemarks[i].SimpleData[4].trim() == place_marks[j]) {
                        this.geoXml.docs[0].placemarks[i].polygon.setMap(this.$map)
                        if (place_marks.length == 1) {
                            let coordsLength = this.geoXml.docs[0].placemarks[i].Polygon[0].outerBoundaryIs[0].coordinates.length

                            let lat = this.geoXml.docs[0].placemarks[i].Polygon[0].outerBoundaryIs[0].coordinates[(coordsLength / 2).toFixed(0)].lat
                            let lng = this.geoXml.docs[0].placemarks[i].Polygon[0].outerBoundaryIs[0].coordinates[(coordsLength / 2).toFixed(0)].lng
                            this.pan_to(lat, lng, 13)

                        }

                    }
                }

            }
        },
        parsePlacemark(node, placemark) {
            var tagNodes = node.getElementsByTagName('Codigo')
            var tag = null
            if (tagNodes && tagNodes.length && (tagNodes.length > 0)) {
                placemark.tag = geoXML3.nodeValue(tagNodes[0])
            }
        },
        toggle() {
            // var tag = document.getElementById('tag').value;
            for (var i = 0; i < this.geoXml.docs[0].placemarks.length; i++) {
                this.geoXml.docs[0].placemarks[i].id = i
                if (this.geoXml.docs[0].placemarks[i].SimpleData[4].trim() == '6006') {
                    this.geoXml.docs[0].placemarks[i].polygon.setMap(null)
                }
            }

        },

    }
}
</script>

<style>

#map {
    background: gray;

    width: 100%;

    /*bottom: -30px;*/

    height: 600px;

    /*transform: rotateX(25deg);*/


}

#map iframe {
    border: none !important;
    outline: none !important;
    margin: 0 !important;
    padding: 0 !important;
}

#map.wide {
    width: 64%;

}

.gmnoprint {
    left: 0px !important;
    bottom: 50px;
}


a[href^="http://maps.google.com/maps"] {
    display: none !important
}

a[href^="https://maps.google.com/maps"] {
    display: none !important
}

.gmnoprint a, .gmnoprint span, .gm-style-cc {
    display: none;
}

.gmnoprint div {
    background: none !important;
}

</style>
