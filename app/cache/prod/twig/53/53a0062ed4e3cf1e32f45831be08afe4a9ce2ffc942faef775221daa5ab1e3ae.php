<?php

/* SonataAdminBundle:CRUD:base_acl_macro.html.twig */
class __TwigTemplate_f026da03f4dd1819afcc068eaf5ced9bd30a20f69452cfaaa8c0684b0116dc0c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 11
        echo "
";
    }

    // line 12
    public function getrender_form($__form__ = null, $__permissions__ = null, $__td_type__ = null, $__admin__ = null, $__admin_pool__ = null, $__object__ = null, ...$__varargs__)
    {
        $context = $this->env->mergeGlobals(array(
            "form" => $__form__,
            "permissions" => $__permissions__,
            "td_type" => $__td_type__,
            "admin" => $__admin__,
            "admin_pool" => $__admin_pool__,
            "object" => $__object__,
            "varargs" => $__varargs__,
        ));

        $blocks = array();

        ob_start();
        try {
            // line 13
            echo "    <form class=\"form-horizontal\"
          action=\"";
            // line 14
            echo twig_escape_filter($this->env, $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "generateUrl", array(0 => "acl", 1 => array("id" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "id", array(0 => (isset($context["object"]) ? $context["object"] : null)), "method"), "uniqid" => $this->getAttribute((isset($context["admin"]) ? $context["admin"] : null), "uniqid", array()), "subclass" => $this->getAttribute($this->getAttribute((isset($context["app"]) ? $context["app"] : null), "request", array()), "get", array(0 => "subclass"), "method"))), "method"), "html", null, true);
            echo "\"
          ";
            // line 15
            if ($this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "multipart", array())) {
                echo " enctype=\"multipart/form-data\"";
            }
            // line 16
            echo "          method=\"POST\"
            ";
            // line 17
            if ( !$this->getAttribute((isset($context["admin_pool"]) ? $context["admin_pool"] : null), "getOption", array(0 => "html5_validate"), "method")) {
                echo "novalidate=\"novalidate\"";
            }
            // line 18
            echo "            >
        ";
            // line 19
            if ((twig_length_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "vars", array()), "errors", array())) > 0)) {
                // line 20
                echo "            <div class=\"sonata-ba-form-error\">
                ";
                // line 21
                echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : null), 'errors');
                echo "
            </div>
        ";
            }
            // line 24
            echo "
        <div class=\"box box-success\">
            <div class=\"body table-responsive no-padding\">
                <table class=\"table\">
                    <colgroup>
                        <col style=\"width: 100%;\"/>
                        ";
            // line 30
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["permissions"]) ? $context["permissions"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["permission"]) {
                // line 31
                echo "                            <col/>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['permission'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 33
            echo "                    </colgroup>

                    ";
            // line 35
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "children", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            foreach ($context['_seq'] as $context["_key"] => $context["child"]) {
                if (($this->getAttribute($this->getAttribute($context["child"], "vars", array()), "name", array()) != "_token")) {
                    // line 36
                    echo "                        ";
                    if ((($this->getAttribute($context["loop"], "index0", array()) == 0) || (($this->getAttribute($context["loop"], "index0", array()) % 10) == 0))) {
                        // line 37
                        echo "                            <tr>
                                <th>";
                        // line 38
                        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans((isset($context["td_type"]) ? $context["td_type"] : null), array(), "SonataAdminBundle"), "html", null, true);
                        echo "</th>
                                ";
                        // line 39
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable((isset($context["permissions"]) ? $context["permissions"] : null));
                        foreach ($context['_seq'] as $context["_key"] => $context["permission"]) {
                            // line 40
                            echo "                                    <th class=\"text-right\">";
                            echo twig_escape_filter($this->env, $context["permission"], "html", null, true);
                            echo "</th>
                                ";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['permission'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 42
                        echo "                            </tr>
                        ";
                    }
                    // line 44
                    echo "
                        <tr>
                            <td>
                                ";
                    // line 47
                    $context["typeChild"] = (($this->getAttribute($context["child"], "role", array(), "array", true, true)) ? ($this->getAttribute($context["child"], "role", array(), "array")) : ($this->getAttribute($context["child"], "user", array(), "array")));
                    // line 48
                    echo "                                ";
                    echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["typeChild"]) ? $context["typeChild"] : null), "vars", array()), "value", array()), "html", null, true);
                    echo "
                                ";
                    // line 49
                    echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["typeChild"]) ? $context["typeChild"] : null), 'widget');
                    echo "
                            </td>
                            ";
                    // line 51
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable((isset($context["permissions"]) ? $context["permissions"] : null));
                    foreach ($context['_seq'] as $context["_key"] => $context["permission"]) {
                        // line 52
                        echo "                                <td class=\"text-right\">";
                        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute($context["child"], $context["permission"], array(), "array"), 'widget', array("label" => false));
                        echo "</td>
                            ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['permission'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 54
                    echo "                        </tr>
                    ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['child'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 56
            echo "                </table>
            </div>
        </div>

        ";
            // line 60
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock($this->getAttribute((isset($context["form"]) ? $context["form"] : null), "_token", array()), 'row');
            echo "

        <div class=\"well well-small form-actions\">
            <input class=\"btn btn-primary\" type=\"submit\" name=\"btn_create_and_edit\" value=\"";
            // line 63
            echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("btn_update_acl", array(), "SonataAdminBundle"), "html", null, true);
            echo "\">
        </div>
    </form>
";
        } catch (Exception $e) {
            ob_end_clean();

            throw $e;
        } catch (Throwable $e) {
            ob_end_clean();

            throw $e;
        }

        return ('' === $tmp = ob_get_clean()) ? '' : new Twig_Markup($tmp, $this->env->getCharset());
    }

    public function getTemplateName()
    {
        return "SonataAdminBundle:CRUD:base_acl_macro.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  187 => 63,  181 => 60,  175 => 56,  164 => 54,  155 => 52,  151 => 51,  146 => 49,  141 => 48,  139 => 47,  134 => 44,  130 => 42,  121 => 40,  117 => 39,  113 => 38,  110 => 37,  107 => 36,  96 => 35,  92 => 33,  85 => 31,  81 => 30,  73 => 24,  67 => 21,  64 => 20,  62 => 19,  59 => 18,  55 => 17,  52 => 16,  48 => 15,  44 => 14,  41 => 13,  24 => 12,  19 => 11,);
    }
}
/* {#*/
/* */
/* This file is part of the Sonata package.*/
/* */
/* (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>*/
/* */
/* For the full copyright and license information, please view the LICENSE*/
/* file that was distributed with this source code.*/
/* */
/* #}*/
/* */
/* {% macro render_form(form, permissions, td_type, admin, admin_pool, object) %}*/
/*     <form class="form-horizontal"*/
/*           action="{{ admin.generateUrl('acl', {'id': admin.id(object), 'uniqid': admin.uniqid, 'subclass': app.request.get('subclass')}) }}"*/
/*           {% if form.vars.multipart %} enctype="multipart/form-data"{% endif %}*/
/*           method="POST"*/
/*             {% if not admin_pool.getOption('html5_validate') %}novalidate="novalidate"{% endif %}*/
/*             >*/
/*         {% if form.vars.errors|length > 0 %}*/
/*             <div class="sonata-ba-form-error">*/
/*                 {{ form_errors(form) }}*/
/*             </div>*/
/*         {% endif %}*/
/* */
/*         <div class="box box-success">*/
/*             <div class="body table-responsive no-padding">*/
/*                 <table class="table">*/
/*                     <colgroup>*/
/*                         <col style="width: 100%;"/>*/
/*                         {% for permission in permissions %}*/
/*                             <col/>*/
/*                         {% endfor %}*/
/*                     </colgroup>*/
/* */
/*                     {% for child in form.children if child.vars.name != '_token' %}*/
/*                         {% if loop.index0 == 0 or loop.index0 % 10 == 0 %}*/
/*                             <tr>*/
/*                                 <th>{{ td_type|trans({}, 'SonataAdminBundle') }}</th>*/
/*                                 {% for permission in permissions %}*/
/*                                     <th class="text-right">{{ permission }}</th>*/
/*                                 {% endfor %}*/
/*                             </tr>*/
/*                         {% endif %}*/
/* */
/*                         <tr>*/
/*                             <td>*/
/*                                 {% set typeChild = child['role'] is defined ? child['role'] : child['user'] %}*/
/*                                 {{ typeChild.vars.value }}*/
/*                                 {{ form_widget(typeChild) }}*/
/*                             </td>*/
/*                             {% for permission in permissions %}*/
/*                                 <td class="text-right">{{ form_widget(child[permission], { label: false }) }}</td>*/
/*                             {% endfor %}*/
/*                         </tr>*/
/*                     {% endfor %}*/
/*                 </table>*/
/*             </div>*/
/*         </div>*/
/* */
/*         {{ form_row(form._token) }}*/
/* */
/*         <div class="well well-small form-actions">*/
/*             <input class="btn btn-primary" type="submit" name="btn_create_and_edit" value="{{ 'btn_update_acl'|trans({}, 'SonataAdminBundle') }}">*/
/*         </div>*/
/*     </form>*/
/* {% endmacro %}*/
/* */
