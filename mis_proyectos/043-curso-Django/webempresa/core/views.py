from django.shortcuts import render

# Create your views here.
def home(request):
    """Home page."""
    return render(request,"core/home.html")
def about(request):
    """About page."""
    return render(request,"core/about.html")

def store(request):
    """Store page."""
    return render(request,"core/store.html")


