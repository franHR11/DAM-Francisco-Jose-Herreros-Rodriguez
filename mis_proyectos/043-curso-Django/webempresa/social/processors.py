
from .models import Link

def ctx_dict(request):
    ctx = {}
    link = Link.objects.all()
    for link in link:
        ctx[link.key] = link.url
    return ctx
    