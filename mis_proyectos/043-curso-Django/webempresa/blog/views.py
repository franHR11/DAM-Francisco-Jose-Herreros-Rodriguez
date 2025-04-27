from django.shortcuts import render, get_object_or_404
from .models import Post, Category


# Create your views here.
def blog(request):
    """Blog page."""
    posts = Post.objects.all()
    return render(request,"blog/blog.html", {"posts": posts})

def category(request, category_id):
    category = get_object_or_404(Category, id=category_id)
    posts = category.post_set.all()
    return render(request,"blog/category.html", {"category": category, "posts": posts})