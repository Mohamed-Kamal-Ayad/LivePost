import './bootstrap';
import Echo from 'laravel-echo';

const form = document.getElementById('form');
const inputMessage = document.getElementById('input-message');
const listMessages = document.getElementById('list-messages');
form.addEventListener('submit', (e) => {
    e.preventDefault();
    const userInput = inputMessage.value;
    axios.post('/chat-message', {
        message: userInput
    });

    const channel = window.Echo.channel('public.chat.1');

    channel.subscribed(() => {
        console.log('subscribed');
    }).listen('.chat-message', (event) => {
        console.log('received event', event);
        const message = event.message;
        const li = document.createElement('li');
        li.textContent = message;
        listMessages.append(li);
    });
});
