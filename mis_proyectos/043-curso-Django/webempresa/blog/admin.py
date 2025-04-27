from django.contrib import admin
from .models import Post, Category

# Register your models here.
from django.utils.html import mark_safe

class PostAdmin(admin.ModelAdmin):
    list_display = ('title', 'published', 'author', 'get_categories', 'image_tag')
    search_fields = ('title', 'content','user__username','categories__name')
    list_filter = ('published', 'author__username', 'categories__name')
    date_hierarchy = 'published'
    ordering = ['-published']
    readonly_fields = ('created', 'updated')
    

    def get_categories(self, obj):
        return ", ".join([cat.name for cat in obj.categories.all()])
    get_categories.short_description = 'Categorías'

    def image_tag(self, obj):
        if obj.image:
            return mark_safe(f'<img src="{obj.image.url}" style="width:40px; height:auto; border-radius:4px;" />')
        return ""
    image_tag.short_description = 'Imagen'

class CategoryAdmin(admin.ModelAdmin):
    list_display = ('name', 'created', 'updated')
    search_fields = ('name',)
    ordering = ['-created']

admin.site.register(Post, PostAdmin)
admin.site.register(Category, CategoryAdmin)