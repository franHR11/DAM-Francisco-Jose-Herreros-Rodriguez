from django import forms
from .models import Page


class PageForm(forms.ModelForm):
    class Meta:
        model = Page
        fields = ['title', 'content', 'order']
        widgets = {
            'title': forms.TextInput(attrs={
                'class': 'form-control',
                'placeholder': 'Título'
            }),
            'content': forms.Textarea(attrs={
                'class': 'form-control',
                'id': 'id_content',
                'rows': 15,  # Aumentamos el número de filas
                'style': 'min-height: 300px;',  # Altura mínima en píxeles
                'width': '100%',
            }),
            'order': forms.NumberInput(attrs={
                'class': 'form-control',
                'placeholder': 'Orden'
            }),
        }
