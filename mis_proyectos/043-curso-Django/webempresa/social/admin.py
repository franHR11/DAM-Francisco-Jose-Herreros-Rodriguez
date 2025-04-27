from typing import override
from django.contrib import admin
from .models import Link

# Register your models here.

class LinkAdmin(admin.ModelAdmin):
    readonly_fields = ('created', 'updated')
    list_display = ('key', 'name', 'url', 'created', 'updated')
    search_fields = ('key', 'name', 'url')
    list_filter = ('key', 'name', 'url')
    ordering = ('-created',)
    
def get_readonly_fields(self, request, obj=None):
    if request.user.groups.filter(name='personal').exists():
        return ('key', 'name', 'created', 'updated')
    else:
        return ('created', 'updated')
    
admin.site.register(Link, LinkAdmin)