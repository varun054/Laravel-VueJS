<template>
    <div>
        <h3 class="mb-3 mt-3 text-white">Employer details</h3>
        <div class="card mb-4">
            <div class="row">
                <div class="card-img-top col-md-6">
                    <div class="d-flex justify-content-start align-items-center p-4">
                        <img class="employer-detail-avatar mr-3" v-bind:src="employer.user.image_url">
                        <div>
                            <h4 class="font-weight-bold">{{employer.company_name}}</h4>
                            <div class="sub-text employer-primary">{{employer.user.name }}</div>
                        </div>
                    </div>
                </div>
                <div class="card-body col-md-6 p-md-3 pt-1">
                    <div class="row">
                        <div class="col-6 col-md-12">
                            <i class="employer-primary fa fa-briefcase fa-lg pr-2 py-2"></i>
                            <span class="font-weight-bold">{{employer.business_type}}</span>
                        </div>
                        <div class="col-6 col-md-12">
                            <i class="employer-primary fa fa-phone fa-lg pr-2 py-2"></i>
                            <span class="font-weight-bold">{{employer.phone}}</span>
                        </div>
                        <div class="col-6 col-md-12">
                            <a class="cursor" :href="'mailto:' + employer.user.email"><i class="employer-primary fa fa-envelope fa-md pr-2 py-2"></i></a>
                            <span class="font-weight-bold">{{employer.user.email}}</span>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <ul class="nav nav-tabs" id="employer-detail-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="info-tab" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="true">Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="jobs-tab" data-toggle="tab" href="#jobs" role="tab" aria-controls="jobs" aria-selected="false">Jobs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="caregivers-tab" data-toggle="tab" href="#caregivers" role="tab" aria-controls="caregivers" aria-selected="false">Caregivers</a>
            </li>
        </ul>
        <div class="tab-content pt-2" id="employer-detail-tab-content">
            <div class="text-white tab-pane fade show active" id="info" role="tabpanel" aria-labelledby="home-tab">
                <div class="col-12">
                    <div class="row p-2">
                        <div class="col-2 text-right"><b>Address:</b></div>
                        <div class="col-10">{{employer.address}}</div> 
                        <div class="col-2 text-right"><b>Address2:</b></div>
                        <div class="col-10">{{employer.address2}}</div> 
                        <div class="col-2 text-right"><b>City:</b></div>
                        <div class="col-10">{{employer.city}}</div> 
                        <div class="col-2 text-right"><b>State:</b></div>
                        <div class="col-10">{{employer.state}}</div> 

                        <div class="col-2 text-right"><b>ZipCode:</b></div>
                        <div class="col-10">{{employer.zipcode}}</div> 
                        <br><br>
                        <div class="col-2 text-right"><b>Administrator</b></div>
                        <div class="col-10"></div>
                        <div class="col-2 text-right"><b>Name:</b></div>
                        <div class="col-10">{{employer.administrator_name}}</div>

                        <div class="col-2 text-right"><b>Phone:</b></div>
                        <div class="col-10">{{employer.administrator_phone}}</div>

                        <div class="col-2 text-right"><b>Email:</b></div>
                        <div class="col-10">{{employer.administrator_email}}</div>
                        
                    </div>
                </div>
            </div>
            <div class="text-white tab-pane fade" id="jobs" role="tabpanel" aria-labelledby="jobs-tab">
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item" v-for="(job, index) in jobs" v-bind:key="index">
                        <b>Shift Title: </b> <label>{{ job.title }}</label> <br>
                        <b>Address: </b><label>{{ job.shift_address1 }}</label><br>
                        <b>City: </b><label>{{ job.shift_city + '-' + job.shift_state}}</label><br>
                        <b>Date: </b> <label>
                        <div v-if="job.date_end">
                            {{ formateDate(job.date_start) }} <i>to</i> {{ formateDate(job.date_end)}}
                        </div>
                        <div v-else>
                           starts at  {{ formateDate(job.date_start) }}
                        </div>
                    </label>
                    </li>
                </ul>
                </div>

                <div class="text-white tab-pane fade" id="caregivers" role="tabpanel" aria-labelledby="caregivers-tab">
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item" v-for="(caregiver, index) in caregivers" v-bind:key="index">
                        <b>Name: </b> <label>{{ caregiver.name }}</label> <br>
                        <b>About me: </b><label>{{ caregiver.caregiver.aboutme }}</label><br>
                        <b>City: </b><label>{{ caregiver.caregiver.city }} -  {{ caregiver.caregiver.state}}</label><br>
                        <b>Address: </b> <label> {{ caregiver.caregiver.address }}</label>
                    </li>
                </ul>
                </div>
            
            <div class="tab-pane fade" id="map" role="tabpanel" aria-labelledby="contact-tab">...</div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['employer'],
    data() {
        return{
            user: [],
            app_url: process.env.MIX_APP_URL,
            auth_user: window.auth_user,
            jobs: [],
            caregivers: []
        }
    },
    mounted() {
        this.loadEmployer();
    },
    methods: {
        async loadEmployer() {
            await axios.get('/api/v1/test/' + 3)
            .then((res) => {
                this.user = res.data.success.user;
                this.jobs = res.data.success.jobs;
                this.caregivers = res.data.success.caregivers;
            })
            .catch((error) => {
                console.log(error);
            })
        },
        downloadHrVault(hrvault){
            axios({
                method: 'get',
                url: hrvault.public_url,
                responseType: 'blob'
            }).then((res) => {
                var blob = new Blob([res.data])
                if(typeof window.navigator.msSaveBlob !== 'undefined'){
                    window.navigator.msSaveBlob(blob, hrvault.file)
                } else {
                    var blobUrl = window.URL.createObjectURL(blob)
                    var tempLink = document.createElement('a')
                    tempLink.style.display = 'none'
                    tempLink.href = blobUrl
                    tempLink.setAttribute('download', hrvault.file)

                    if( typeof tempLink.download === 'undefined') {
                        tempLink.setAttribute('target', '_blank')
                    }
                    document.body.appendChild(tempLink)
                    tempLink.click()
                    document.body.removeChild(tempLink)
                    window.URL.revokeObjectURL(blobUrl)
                }
            })
        },
        printHrVault(hrVault){
            printJS({
                printable: hrVault.public_url,
                type: 'image',
                style: 'img { width: 50% !important; }'
            })
        },
        formateTime(time) {
                return moment(time, "HH:mm:ss").format("hh:mm A");
        },
        formateDate(date) {
                return moment(date).format('MMMM DD, YYYY');
        },
    }
}
</script>

<style scope>
    main {
        background: #1FC3f8;
    }
    .cursor{
        cursor: pointer;
    }

    .employer-primary {
        color: #1FC3f8;
    }
    a{
        color: white;
        text-decoration: none;
    }
    .employer-detail-section {
        background-color: #fff;
        background-clip: border-box;
        border: 1px solid #ecf2f3;
        border-radius: 10px;
        padding: 30px 20px 30px 20px;
        margin-top: 20px;
    }

    .cursor-pointer {
        cursor: pointer;
    }
    .employer-detail-avatar {
        vertical-align: middle;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: white !important;
    }

    .employer-detail-section .row {
        margin-left: 0 !important;
        margin-right: 0 !important;
    }

    .employer-detail-section ul {
        margin-top: 0.5rem !important;
    }
    .list-group-item:nth-child(2n) {
        background: #1FC3f8;
    }
    .list-group-item:nth-child(2n+1) {
        background: #24AEDA;
    }
</style>
