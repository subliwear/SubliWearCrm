<template>
    <div class="border rounded-lg p-6">
        <div class="chat-header flex justify-between mb-6">
            <div class="left w-1/2">
                <div class="mb-1 font-semibold leading-normal text-lg text-slate-700">
                    Intitulé de Projet : {{ project_title }} 
                    <input v-if="is_admin" v-model="code" type="text" placeholder="Set Tracking Code" class="ml-11 focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft inline w-32 appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow rounded-br-none rounded-tr-none">
                    <button v-if="is_admin" class="appearance-none bg-clip-padding bg-white border border-gray-300 border-solid ease-soft focus:border-fuchsia-300 focus:outline-none focus:shadow-soft-primary-outline focus:transition-shadow font-normal inline leading-5.6 px-3 py-2 rounded-bl-none rounded-lg rounded-tl-none text-gray-700 text-sm transition-all border-l-0 bg-gray-200" @click="saveCode">Save</button>
                    <span class="text-lime-500 ml-2 text-3xs" v-if="is_code_saved">Saved</span>
                </div>
                <div class="leading-tight text-xs">
                    #{{ project_id }}
                </div>
                <div class="tabs w-full">
                    <div class="flex pt-2 items-center">
                        <button @click="show='messages'" :class="show=='messages'?'border border-slate-700 text-slate-700 rounded shadow px-2 py-1':' mx-2'">Messages</button>
                        <button @click="show='uploads'" :class="show=='uploads'?'border border-slate-700 text-slate-700 rounded shadow px-2 py-1':' mx-2'">Uploads</button>
                        <button @click="show='notes'" :class="show=='notes'?'border border-slate-700 text-slate-700 rounded shadow px-2 py-1':' mx-2'" v-if="is_customer!=='true'">Notes</button>
                    </div>
                </div>
            </div>
            <div class="right w-50 rounded-2xl bg-gray-200 p-4 flex gap-20">
                <div>
                    <div class="leading-tight text-xs mb-1">Customer:</div>
                    <div class="flex mb-4">
                        <div class="mr-1">
                            <img :src="'https://api.dicebear.com/6.x/notionists-neutral/svg?seed='+customer.email" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-soft-in-out h-9 w-9 rounded-circle border" alt="user1" />
                        </div>
                        <div>
                            <div class="mb-1 font-semibold leading-normal text-sm text-slate-700">
                                {{ customer.name }}
                            </div>
                            <div class="leading-tight text-xs">
                                {{customer.email}}
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="leading-tight text-xs mb-1">Designer:</div>
                    <div class="flex">
                        <div class="mr-1">
                            <img :src="'https://api.dicebear.com/6.x/notionists-neutral/svg?seed='+manager.email" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-soft-in-out h-9 w-9 rounded-circle border" alt="user1" />
                        </div>
                        <div>
                            <div class="mb-1 font-semibold leading-normal text-sm text-slate-700">
                                {{ manager.name }}
                            </div>
                            <div class="leading-tight text-xs">
                                {{manager.email}}
                            </div>
                        </div>
                    </div>
                </div>
                <button v-if="is_ordered!==1 && manager" @click="makeOrder" class="ml-auto px-6 py-3 mb-0 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-blue-600 to-cyan-400 hover:scale-102 hover:shadow-soft-xs active:opacity-85 flex justify-center items-center" :disabled="ordering">Make an order <div class="loading" v-if="ordering"></div></button>
                <div v-if="is_ordered==1 && is_customer!=='true' && is_customer!=='1' && is_customer!==1">
                    <div class="text-sm mb-1 relative">
                        Status: 
                        <span class="flex">
                            <span :class="[status.background_color, status.text_color, 'rounded px-2 bg-gradient-to-tl cursor-pointer']" @click="openStatuses">
                                {{ status.title }}
                            </span>
                            <span :class="[status.background_color, status.text_color, 'rounded px-2 bg-gradient-to-tl cursor-pointer']" @click="openStatuses">
                                <svg fill="currentcolor" xmlns="http://www.w3.org/2000/svg" height="10px" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M233.4 406.6c12.5 12.5 32.8 12.5 45.3 0l192-192c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L256 338.7 86.6 169.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l192 192z"/></svg>
                            </span>
                        </span>
                        <div class="absolute bg-white rounded shadow-soft-3xl right-0" v-if="show_status_modal"> 
                            <div class="py-1 px-4 cursor-pointer whitespace-nowrap"  v-for="(st, i) in statuses" :class="i==statuses.length-1?'border-b-0':'border-b'" @click="new_status = st.id; show_status_modal = false">{{ st.title }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="show=='messages'" class="chat-body rounded-2xl bg-gray-50 p-6"  @scroll="stopAutoJumping">
            <div class="message" v-for="message in messages">
                <message v-if="message.type=='message'" :message="message" :customer="customer" :manager="manager" />
                <upload v-if="message.type=='upload'" :message="message" :customer="customer" :manager="manager" />
                <patronage v-if="message.type=='patronage'" :message="message" :customer="customer" :manager="manager" />
            </div>
            <div class="loading2" v-if="loading"></div>
        </div>
        <div v-if="show=='messages' && is_ordered!==1" class="chat-hooter mt-2 w-full flex">
            <textarea class="bg-white/80 border p-2 rounded-br-none rounded-lg rounded-tr-none w-1/2" placeholder="Type your message..." v-model="text"></textarea>
            <div class="bg-gray-200 w-1/2 rounded-lg rounded-tl-none rounded-bl-none">
                <fileuploader @change="f=>files=f" ref="uploader"/>
            </div>
        </div>
        <div v-if="show=='messages' && is_ordered!==1" class="text-center chat-button">
            <button :disabled=sending @click="sendMessage" class="flex justify-center items-center inline-block w-full px-6 py-3 mt-6 mb-0 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-blue-600 to-cyan-400 hover:scale-102 hover:shadow-soft-xs active:opacity-85">Send
                <div class="loading" v-if="sending"></div>
            </button>
        </div>

        <div v-if="show=='uploads'" class="chat-body rounded-2xl bg-gray-50 p-6" style="box-shadow: inset 0 2px 5px rgba(0,0,0,.05);">
            <div class="message" v-for="message in uploads">
                <!-- {{ message }} -->
                <upload-section :message="message" :customer="customer" :manager="manager" />
            </div>
        </div>

        <div v-if="show=='notes'" class="chat-body rounded-2xl bg-gray-50 p-6" style="box-shadow: inset 0 2px 5px rgba(0,0,0,.05);">
            <div class="message" v-for="message in notes">
                <!-- {{ message }} -->
                <note-section :message="message" :customer="customer" :manager="manager" />
            </div>
        </div>
        <div v-if="show=='notes' && is_ordered!==1" class="chat-hooter mt-2 w-full flex">
            <textarea class="bg-white/80 border p-2 rounded-lg w-full" placeholder="Type your note..." v-model="note_text"></textarea>
        </div>
        <div v-if="show=='notes' && is_ordered!==1" class="text-center chat-button">
            <button @click="sendNote" class="inline-block w-full px-6 py-3 mt-6 mb-0 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-x-25 bg-150 leading-pro text-xs ease-soft-in tracking-tight-soft bg-gradient-to-tl from-blue-600 to-cyan-400 hover:scale-102 hover:shadow-soft-xs active:opacity-85">Add note</button>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    import message from './partials/message-types/message.vue'
    import upload from './partials/message-types/upload.vue'
    import uploadSection from './partials/message-types/upload-section.vue'
    import patronage from './partials/message-types/patronage.vue'
    import noteSection from './partials/message-types/note-section.vue'
    import fileuploader from './partials/fileuploader.vue';
    import Swal from 'sweetalert2';


    export default{
        components: {
            message, upload, patronage, fileuploader, uploadSection, noteSection
        },
        props: {
            order_id: {
                type: String
            },
            project_id: {
                type: String
            },
            project_title: {
                type: String
            },
            project_uid: {
                type: String
            },
            is_admin: {
                type: Boolean
            },
            is_customer: {
                type: Boolean
            },
            is_ordered: {
                type: Boolean
            },
            customer: {
                type: Object
            },
            manager: {
                type: Object
            }
        },
        data(){
            return {
                is_code_saved: false,
                jump_interval: null,

                messages: [],
                uploads: [],
                loading: false,
                sending: false,
                ordering: false,
                notes: [],
                text: '',
                note_text: '',
                files: [],
                show: 'messages',

                status: {},
                statuses: [],
                new_status: '',

                code: '',

                ot: 0,
                ch: 0,
                bh: 0,

                show_status_modal: false
            }
        },
        methods: {
            stopAutoJumping(){
                clearInterval(this.jump_interval)
            },
            openStatuses(){
                this.show_status_modal = !this.show_status_modal
            },
            load(){
                this.loading = true
                axios.get('/json/project/'+this.project_id).then(response=>{
                    this.messages = response.data.messages
                    this.uploads = response.data.uploads
                    this.notes = response.data.notes
                })
                if(this.is_ordered){
                    axios.get('/json/statuses/').then(response=>{
                        this.statuses = response.data.statuses
                    })
                    axios.get('/json/status/'+this.project_id).then(response=>{
                        this.status = response.data.status
                    })
                }
                setTimeout(()=>{
                    document.querySelector('.chat-body').scrollTop = document.querySelector('.chat-body').scrollHeight;
                    this.loading = false
                }, 200)
            },
            sendMessage(){
                this.sending = true
                axios.post('/json/message', {text: this.text, project_id: this.project_id, files: this.files}).then(() => {
                    this.load()
                    this.files = []
                    this.$refs.uploader.clearList()
                    this.text = ''
                    this.sending = false
                })
            },
            sendNote(){
                axios.post('/json/note', {text: this.note_text, project_id: this.project_id}).then(() => {
                    this.load()
                    this.note_text = ''
                })
            },
            makeOrder(){
                this.ordering = true
                axios.post('/json/order/'+this.project_id).then(response=>{
                    this.ordering = false
                    window.location = response.data.redirect
                }).catch(error => {
             this.ordering = false;
             if (error.response) {
                 // Si le serveur a répondu avec un code d'erreur
                 console.error('Server responded with status:', error.response.status);
                 alert('An error occurred. Please try again later.');
             } else if (error.request) {
                 // Si la requête a été faite mais aucune réponse n'a été reçue
                 console.error('Request made but no response received.');
                 alert('No response from the server. Please try again later.');
             } else {
                 // Si une erreur s'est produite lors de la configuration de la requête
                 console.error('Error setting up the request:', error.message);
                 alert('Error setting up the request. Please try again later.');
             }
            })
            },
            saveCode(){
                if(this.is_ordered){
                    axios.post('/json/codeorder/'+this.order_id+'&is_order='+this.is_ordered, {code: this.code}).then(()=>{
                        this.is_code_saved = true
                        setTimeout(()=>{
                            this.is_code_saved = false
                        }, 5000)
                    })
                }else{
                    axios.post('/json/code/'+this.project_id+'&is_order='+this.is_ordered, {code: this.code}).then(()=>{
                        this.is_code_saved = true
                        setTimeout(()=>{
                            this.is_code_saved = false
                        }, 5000)
                    })
                }
            }
        },
        mounted(){
            console.log(this.is_customer)
            this.code = this.project_uid
            this.is_admin_bool = this.is_admin=='1'?true:false
            this.load()
            setTimeout(()=>{
                this.ot = document.querySelector('.chat-body').offsetTop + document.querySelector('.chat-body').offsetParent.offsetTop
                if(document.querySelector('.chat-hooter'))
                    this.ch = document.querySelector('.chat-hooter').offsetHeight
                if(document.querySelector('.chat-button'))
                    this.bh = document.querySelector('.chat-button').offsetHeight
                document.querySelector('.chat-body').style.height = (window.innerHeight - this.ot - this.ch - this.bh - 20)+'px'
                document.querySelector('.chat-body').style.overflow = 'auto'
            }, 1000)
            window.addEventListener('resize', ()=>{
                setTimeout(()=>{
                    this.ot = document.querySelector('.chat-body').offsetTop + document.querySelector('.chat-body').offsetParent.offsetTop
                    if(document.querySelector('.chat-hooter'))
                        this.ch = document.querySelector('.chat-hooter').offsetHeight
                    if(document.querySelector('.chat-button'))
                        this.bh = document.querySelector('.chat-button').offsetHeight
                    document.querySelector('.chat-body').style.height = (window.innerHeight - this.ot - this.ch - this.bh - 20)+'px'
                    document.querySelector('.chat-body').style.overflow = 'auto'
                }, 1000)
            })
            this.jump_interval = setInterval(() => {
                this.load()
            }, 5000);
        },
        watch: {
            show(){
                setTimeout(()=>{
                    // this.ot = document.querySelector('.chat-body').offsetTop
                    // this.ch = document.querySelector('.chat-hooter').offsetHeight
                    document.querySelector('.chat-body').style.height = (window.innerHeight - this.ot - this.ch - this.bh - 20)+'px'
                    document.querySelector('.chat-body').style.overflow = 'auto'
                }, 1000)
            },
            
            new_status() {
                axios.post('/json/status/' + this.project_id, { status: this.new_status })
                    .then(() => {
                        this.load();
                        Swal.fire({
                            icon: 'success',
                            title: 'Succès !',
                            text: 'Votre statut a été mis à jour avec succès.',
                            timer: 3000, // Spécifiez la durée en millisecondes
                            timerProgressBar: true, // Affiche une barre de progression du minuteur
                        });
                    })
                    .catch(error => {
                        console.error('Error updating status:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Une erreur s\'est produite lors de la mise à jour du statut.'
                        });
                    });
            }

        }
    }
</script>
<style>
    .bg-green{
        background: #cbf5d4;
    }
    .bg-gray{
        background: #ced4da;
    }
    .object-fit{
        object-fit: cover;
    }
    .gap-10{
        gap: 10px;
    }
    .gap-20{
        gap: 20px;
    }
    .chat-hooter .filepond--root.my-pond.filepond--hopper{
        margin-bottom: 0;
    }
    /* .loading, */
    /* .loading:after {
    border-radius: 50%;
    width: 20px;
    height: 20px;
    }
    .loading {
    margin: 0 10px;
    font-size: 10px;
    position: relative;
    text-indent: -9999em;
    border-top: 5px solid rgba(255, 255, 255, 0.2);
    border-right: 5px solid rgba(255, 255, 255, 0.2);
    border-bottom: 5px solid rgba(255, 255, 255, 0.2);
    border-left: 5px solid #ffffff;
    -webkit-transform: translateZ(0);
    -ms-transform: translateZ(0);
    transform: translateZ(0);
    -webkit-animation: load8 1.1s infinite linear;
    animation: load8 1.1s infinite linear;
    } */
    @-webkit-keyframes load8 {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
    }
    @keyframes load8 {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
    }
    }
    /* .loading2,
    .loading2:after {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    } */
    /* .loading2 {
    margin: 20px auto;
    font-size: 10px;
    position: relative;
    text-indent: -9999em;
    border-top: 5px solid rgba(255, 255, 255, 0.2);
    border-right: 5px solid rgba(255, 255, 255, 0.2);
    border-bottom: 5px solid rgba(255, 255, 255, 0.2);
    border-left: 5px solid #2152ff;
    -webkit-transform: translateZ(0);
    -ms-transform: translateZ(0);
    transform: translateZ(0);
    -webkit-animation: load8 1.1s infinite linear;
    animation: load8 1.1s infinite linear;
    } */

</style>