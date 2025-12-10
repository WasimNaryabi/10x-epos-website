<template>
    <Teleport to="body">
        <Transition name="modal">
            <div v-if="show" class="modal-overlay" @click="closeModal">
                <div class="modal-container" @click.stop>
                    <button class="modal-close" @click="closeModal">
                        <i class="fas fa-times"></i>
                    </button>

                    <div class="modal-header">
                        <h2>Request a Free Demo</h2>
                        <p>See 10x Global EPOS in action! Book your personalized demo today.</p>
                    </div>

                    <form @submit.prevent="submitForm" class="modal-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="demo-name">Full Name *</label>
                                <input 
                                    type="text" 
                                    id="demo-name"
                                    v-model="form.name"
                                    class="form-input"
                                    :class="{ 'input-error': errors.name }"
                                    required
                                />
                                <span v-if="errors.name" class="error-message">{{ errors.name }}</span>
                            </div>

                            <div class="form-group">
                                <label for="demo-email">Email Address *</label>
                                <input 
                                    type="email" 
                                    id="demo-email"
                                    v-model="form.email"
                                    class="form-input"
                                    :class="{ 'input-error': errors.email }"
                                    required
                                />
                                <span v-if="errors.email" class="error-message">{{ errors.email }}</span>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="demo-phone">Phone Number</label>
                                <input 
                                    type="tel" 
                                    id="demo-phone"
                                    v-model="form.phone"
                                    class="form-input"
                                />
                            </div>

                            <div class="form-group">
                                <label for="demo-company">Company Name</label>
                                <input 
                                    type="text" 
                                    id="demo-company"
                                    v-model="form.company_name"
                                    class="form-input"
                                />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="demo-business">Business Type *</label>
                                <select 
                                    id="demo-business"
                                    v-model="form.business_type"
                                    class="form-input"
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
                            </div>

                            <div class="form-group">
                                <label for="demo-type">Demo Type</label>
                                <select 
                                    id="demo-type"
                                    v-model="form.demo_type"
                                    class="form-input"
                                >
                                    <option value="online">Online Demo</option>
                                    <option value="in-person">In-Person Demo</option>
                                    <option value="phone">Phone Call</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="demo-notes">Additional Notes</label>
                            <textarea 
                                id="demo-notes"
                                v-model="form.notes"
                                class="form-input"
                                rows="3"
                                placeholder="Tell us about your business and what you'd like to see..."
                            ></textarea>
                        </div>

                        <button 
                            type="submit" 
                            class="submit-btn"
                            :disabled="processing"
                        >
                            <span v-if="!processing">
                                <i class="fas fa-calendar-check"></i>
                                Request Demo
                            </span>
                            <span v-else>
                                <i class="fas fa-spinner fa-spin"></i>
                                Submitting...
                            </span>
                        </button>
                    </form>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>

<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    show: Boolean
});

const emit = defineEmits(['close', 'submitted']);

const form = useForm({
    name: '',
    email: '',
    phone: '',
    company_name: '',
    business_type: '',
    demo_type: 'online',
    notes: ''
});

const errors = ref({});
const processing = ref(false);

const closeModal = () => {
    emit('close');
};

const submitForm = () => {
    errors.value = {};
    processing.value = true;

    form.post(route('demo.submit'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            emit('submitted', 'Demo request submitted successfully! We\'ll contact you soon.');
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

// Close modal on ESC key
watch(() => props.show, (newVal) => {
    if (newVal) {
        document.addEventListener('keydown', handleEscape);
    } else {
        document.removeEventListener('keydown', handleEscape);
    }
});

const handleEscape = (e) => {
    if (e.key === 'Escape') {
        closeModal();
    }
};
</script>

<style scoped>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(4px);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    padding: 1rem;
}

.modal-container {
    background: white;
    border-radius: 20px;
    max-width: 700px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
}

.modal-close {
    position: absolute;
    top: 1.5rem;
    right: 1.5rem;
    background: #f1f5f9;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s;
    color: #64748b;
    font-size: 1.25rem;
}

.modal-close:hover {
    background: #667eea;
    color: white;
    transform: rotate(90deg);
}

.modal-header {
    padding: 3rem 3rem 1.5rem;
    border-bottom: 2px solid #f1f5f9;
}

.modal-header h2 {
    font-size: 2rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 0.75rem;
}

.modal-header p {
    color: #64748b;
    font-size: 1rem;
}

.modal-form {
    padding: 2rem 3rem 3rem;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
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
    min-height: 80px;
}

.submit-btn {
    width: 100%;
    padding: 1rem 2rem;
    background: linear-gradient(135deg, #667eea, #764ba2);
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
    margin-top: 1rem;
}

.submit-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
}

.submit-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Modal Transitions */
.modal-enter-active,
.modal-leave-active {
    transition: opacity 0.3s ease;
}

.modal-enter-from,
.modal-leave-to {
    opacity: 0;
}

.modal-enter-active .modal-container,
.modal-leave-active .modal-container {
    transition: transform 0.3s ease;
}

.modal-enter-from .modal-container,
.modal-leave-to .modal-container {
    transform: scale(0.9);
}

@media (max-width: 768px) {
    .modal-header {
        padding: 2rem 1.5rem 1rem;
    }

    .modal-header h2 {
        font-size: 1.5rem;
    }

    .modal-form {
        padding: 1.5rem;
    }

    .form-row {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .modal-close {
        top: 1rem;
        right: 1rem;
    }
}
</style>