from django.shortcuts import render, redirect
from django.urls import reverse
from .form import ContactForm
from django.core.mail import EmailMessage

# Create your views here.

def contact(request):
    """Contact page."""
    contact_form = ContactForm()

    if request.method == "POST":
        contact_form = ContactForm(request.POST)
        if contact_form.is_valid():
            name = request.POST.get('name', '')
            email = request.POST.get('email', '')
            content = request.POST.get('content', '')
            
#enviar email

            # Enviar email
            email = EmailMessage(
                "Mensaje desde Web Cafeteria",
                f"De {name} <{email}>\n\nAsunto: \n\nMensaje:\n{content}",
                "noreply@inbox.mailtrap.io",
                ["franhr1113@gmail.com"],
                reply_to=[email]
            )
            
            try:
                email.send()
                return redirect(reverse('contact') + "?ok")
            except:
                return redirect(reverse('contact') + "?error")
            
    return render(request,"contact/contact.html",{"contact_form": contact_form})