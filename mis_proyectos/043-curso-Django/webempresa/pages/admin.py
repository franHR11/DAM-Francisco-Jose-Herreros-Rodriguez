from django.contrib import admin
from .models import Page

# Register your models here.

class PageAdmin(admin.ModelAdmin):
    readonly_fields = ('created', 'updated')
    list_display = ('title', 'content', 'order', 'created', 'updated')
    search_fields = ('title', 'content')
    list_filter = ('title', 'order')
    ordering = ('title',)

admin.site.register(Page, PageAdmin)