from django.contrib import admin
from .models import Service

# Register your models here.
class ServiceAdmin(admin.ModelAdmin):
    list_display = ('title', 'subtitle', 'content', 'image', 'created', 'updated')
    search_fields = ('title', 'subtitle', 'content')
    list_filter = ('created', 'updated')
    list_editable = ('subtitle', 'content', 'image')
    list_per_page = 10 
    readonly_fields = ('created', 'updated')     
    
admin.site.register(Service, ServiceAdmin)