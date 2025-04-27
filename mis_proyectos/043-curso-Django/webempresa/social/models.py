from django.db import models

# Create your models here.

class Link(models.Model):
    key= models.SlugField(max_length=100, unique=True, verbose_name="Key")
    name= models.CharField(max_length=200, verbose_name="Red Social")
    url= models.URLField(verbose_name="Enlace" , max_length=200, blank=True, null=True)
    created= models.DateTimeField(auto_now_add=True, verbose_name="Creado")
    updated= models.DateTimeField(auto_now=True, verbose_name="Actualizado")
    
    class Meta:
        verbose_name= "Enlace"
        verbose_name_plural= "Enlaces"
        ordering= ["-created"]
    
    def __str__(self):
        return self.name
    