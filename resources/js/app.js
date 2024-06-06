import './bootstrap';
import {createApp} from 'vue/dist/vue.esm-bundler.js';
import CreateNewProject from './components/create-new-project.vue'
import ProjectChat from './components/project-chat.vue'
import UploadCategory from './components/upload-category.vue'
import UploadCategoryEdit from './components/upload-category-edit.vue'
import PatronageCategoriesSelector from './components/patronage-categories-selector.vue'
import PatronageCustomerSelector from './components/patronage-customer-selector.vue'


const app = createApp({});

app.component('create-new-project', CreateNewProject);
app.component('project-chat', ProjectChat);
app.component('upload-category', UploadCategory);
app.component('upload-category-edit', UploadCategoryEdit);
app.component('patronage-categories-selector', PatronageCategoriesSelector);
app.component('patronage-customer-selector', PatronageCustomerSelector);

app.mount("#app");
                       
// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();

