<template>
    <div class="toast-container">
        <div class="toast success">
            <div class="toast-icon">
                <Icon name="check" :size="24" color="#10b981" />
            </div>
            <div class="toast-content">
                <div class="toast-title">Success!</div>
                <div class="toast-message">{{ message }}</div>
            </div>
            <button class="toast-close" @click="$emit('close')">
                <Icon name="close" :size="18" color="#94a3b8" />
            </button>
        </div>
    </div>
</template>

<script setup>
import Icon from '@/Components/Shared/Icon.vue';

defineProps({
    message: {
        type: String,
        default: 'Operation completed successfully!'
    }
});

defineEmits(['close']);
</script>

<style scoped>
.toast-container {
    position: fixed;
    top: 2rem;
    right: 2rem;
    z-index: 10000;
}

.toast {
    background: white;
    border-radius: 12px;
    padding: 1rem 1.5rem;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    display: flex;
    align-items: center;
    gap: 1rem;
    min-width: 350px;
    max-width: 500px;
    animation: slideIn 0.3s ease;
}

.toast.success {
    border-left: 4px solid #10b981;
}

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.toast-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #d1fae5;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.toast-content {
    flex: 1;
}

.toast-title {
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.25rem;
}

.toast-message {
    color: #64748b;
    font-size: 0.9rem;
    line-height: 1.4;
}

.toast-close {
    background: none;
    border: none;
    color: #94a3b8;
    cursor: pointer;
    padding: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: color 0.3s;
}

.toast-close:hover {
    color: #0f172a;
}

@media (max-width: 768px) {
    .toast-container {
        right: 1rem;
        left: 1rem;
        top: 1rem;
    }

    .toast {
        min-width: unset;
        width: 100%;
    }
}
</style>