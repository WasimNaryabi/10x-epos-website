<template>
    <section id="contact" class="contact-section">
        <div class="contact-container">
            <!-- Section Header -->
            <div class="section-header" data-aos="fade-up">
                <h2 class="section-title">Request a demo</h2>
                <p class="section-subtitle">
                    Ready to transform your restaurant business? Contact us today for a free consultation
                </p>
            </div>

            <div class="contact-grid">
                <!-- Contact Information -->
                <div class="contact-info" data-aos="fade-right">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <Icon name="location" :size="24" color="white" />
                        </div>
                        <div class="contact-details">
                            <h4>Visit Us</h4>
                            <p>10x Global EPOS Ltd<br>London, United Kingdom</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <Icon name="phone" :size="24" color="white" />
                        </div>
                        <div class="contact-details">
                            <h4>Call Us</h4>
                            <p>
                                Sales: +44 20 1234 5678<br>
                                Support: +44 20 8765 4321<br>
                                Mon-Fri, 9am-8pm GMT
                            </p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <Icon name="email" :size="24" color="white" />
                        </div>
                        <div class="contact-details">
                            <h4>Email Us</h4>
                            <p>
                                Sales: <a href="mailto:sales@10xglobal.co.uk">sales@10xglobal.co.uk</a><br>
                                Support: <a href="mailto:support@10xglobal.co.uk">support@10xglobal.co.uk</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-form-wrapper" data-aos="fade-left">
                    <form @submit.prevent="submitForm" class="contact-form">
                        <!-- Name -->
                        <div class="form-group">
                            <label for="name" class="form-label">
                                Full Name <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                v-model="form.name"
                                class="form-input"
                                :class="{ 'input-error': errors.name }"
                                required
                            />
                            <span v-if="errors.name" class="error-message">{{ errors.name }}</span>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email" class="form-label">
                                Email Address <span class="required">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                v-model="form.email"
                                class="form-input"
                                :class="{ 'input-error': errors.email }"
                                required
                            />
                            <span v-if="errors.email" class="error-message">{{ errors.email }}</span>
                        </div>

                        <!-- Phone -->
                        <div class="form-group">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input 
                                type="tel" 
                                id="phone" 
                                v-model="form.phone"
                                class="form-input"
                                :class="{ 'input-error': errors.phone }"
                            />
                            <span v-if="errors.phone" class="error-message">{{ errors.phone }}</span>
                        </div>

                        <!-- Business Type -->
                        <div class="form-group">
                            <label for="business" class="form-label">
                                Business Type <span class="required">*</span>
                            </label>
                            <select 
                                id="business" 
                                v-model="form.business_type"
                                class="form-input"
                                :class="{ 'input-error': errors.business_type }"
                                required
                            >
                                <option value="">Select...</option>
                                <option value="cafe">Cafe</option>
                                <option value="restaurant">Restaurant</option>
                                <option value="fast-food">Fast Food</option>
                                <option value="fine-dining">Fine Dining</option>
                                <option value="chain">Chain/Franchise</option>
                                <option value="other">Other</option>
                            </select>
                            <span v-if="errors.business_type" class="error-message">{{ errors.business_type }}</span>
                        </div>

                        <!-- Message -->
                        <div class="form-group full-width">
                            <label for="message" class="form-label">
                                Message <span class="required">*</span>
                            </label>
                            <textarea 
                                id="message" 
                                v-model="form.message"
                                class="form-input"
                                :class="{ 'input-error': errors.message }"
                                rows="5"
                                required
                            ></textarea>
                            <span v-if="errors.message" class="error-message">{{ errors.message }}</span>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            class="submit-btn"
                            :disabled="processing"
                        >
                            <span v-if="!processing">
                                <Icon name="email" :size="20" color="white" />
                                Send Message
                            </span>
                            <span v-else>
                                <Icon name="clock" :size="20" color="white" />
                                Sending...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Icon from '@/Components/Shared/Icon.vue';

const emit = defineEmits(['form-submitted']);

const form = useForm({
    name: '',
    email: '',
    phone: '',
    business_type: '',
    message: ''
});

const errors = ref({});
const processing = ref(false);

const submitForm = () => {
    // Clear previous errors
    errors.value = {};
    processing.value = true;

    form.post(route('contact.submit'), {
        preserveScroll: true,
        onSuccess: () => {
            // Reset form
            form.reset();
            emit('form-submitted', 'Thank you for contacting us! We\'ll get back to you within 24 hours.');
            processing.value = false;
        },
        onError: (error) => {
            errors.value = error;
            processing.value = false;
        },
        onFinish: () => {
            processing.value = false;
        }
    });
};
</script>

<style scoped>
.contact-section {
    padding: 6rem 2rem;
    background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
}

.contact-container {
    max-width: 1400px;
    margin: 0 auto;
}

.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 1rem;
}

.section-subtitle {
    font-size: 1.125rem;
    color: #64748b;
    max-width: 600px;
    margin: 0 auto;
}

.contact-grid {
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 3rem;
    align-items: start;
}

/* Contact Info */
.contact-info {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.contact-item {
    display: flex;
    gap: 1.5rem;
    padding: 1.5rem;
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s, box-shadow 0.3s;
}

.contact-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
}

.contact-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.contact-details h4 {
    font-size: 1.125rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.5rem;
}

.contact-details p {
    color: #64748b;
    line-height: 1.6;
}

.contact-details a {
    color: #667eea;
    text-decoration: none;
    transition: color 0.3s;
}

.contact-details a:hover {
    color: #764ba2;
}

/* Contact Form */
.contact-form-wrapper {
    background: white;
    border-radius: 20px;
    padding: 2.5rem;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
}

.contact-form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.form-label {
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.required {
    color: #ef4444;
}

.form-input {
    padding: 0.875rem 1.125rem;
    border: 2px solid #e2e8f0;
    border-radius: 10px;
    font-size: 1rem;
    transition: all 0.3s;
    font-family: 'Poppins', sans-serif;
}

.form-input:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
}

.form-input.input-error {
    border-color: #ef4444;
}

.error-message {
    color: #ef4444;
    font-size: 0.85rem;
    margin-top: 0.25rem;
}

select.form-input {
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 1.5rem;
    padding-right: 2.5rem;
}

textarea.form-input {
    resize: vertical;
    min-height: 120px;
}

.submit-btn {
    grid-column: 1 / -1;
    padding: 1rem 2rem;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    color: white;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
}

.submit-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
}

.submit-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .contact-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .contact-section {
        padding: 4rem 1rem;
    }

    .section-title {
        font-size: 2rem;
    }

    .contact-form {
        grid-template-columns: 1fr;
    }

    .contact-form-wrapper {
        padding: 1.5rem;
    }
}
</style>