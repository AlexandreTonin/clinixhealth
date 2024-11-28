package com.example;

import org.apache.camel.Exchange;
import org.apache.camel.builder.RouteBuilder;
import org.apache.camel.impl.DefaultCamelContext;

public class Main {

    public static void main(String[] args) throws Exception {
        // Cria o contexto do Camel
        DefaultCamelContext context = new DefaultCamelContext();

        // Define a rota do Camel
        context.addRoutes(new RouteBuilder() {
            @Override
            public void configure() throws Exception {
                // Rota para escutar requisição SOAP via HTTP
                from("jetty://http://localhost:8080/soap-paciente")
                    // Converte o corpo para String para garantir a leitura
                    .convertBodyTo(String.class)
                    // Extrai o patientCpf manualmente
                    .log("Requisição SOAP (xml) recebida")
                    .log("ㅤ")
                    .log("--------------------------------------------")
                    .log("${body}")
                    .log("--------------------------------------------")
                    .log("ㅤ")
                    .log("Processando XML (extraindo o cpf do paciente)")
                    .process(exchange -> {
                        String body = exchange.getIn().getBody(String.class);

                        // Extrai o conteúdo entre as tags <patientCpf> e </patientCpf>
                        String startTag = "<patientCpf>";
                        String endTag = "</patientCpf>";
                        String patientCpf = null;

                        if (body.contains(startTag) && body.contains(endTag)) {
                            int startIndex = body.indexOf(startTag) + startTag.length();
                            int endIndex = body.indexOf(endTag);
                            patientCpf = body.substring(startIndex, endIndex).trim();
                        }

                        // Exibe o CPF no console
                        if (patientCpf != null) {
                            exchange.getIn().setHeader("patientCpf", patientCpf);
                        }
                    })
                    .log("CPF extraido do xml: ${header.patientCpf}")
                    .log("Enviando requisicao para o servico externo")
                    .setHeader(Exchange.HTTP_URI, simple("http://localhost:3000/v1/patient/medical-record?patientCpf=${header.patientCpf}"))
                    // Define o método HTTP como GET
                    .setHeader(Exchange.HTTP_METHOD, constant("GET"))
                    // Envia a requisição para o serviço externo
                    .to("http://localhost:3000")
                    // Log para verificar a resposta
                    .log("resposta do servico externo foi recebida com sucesso")
                    .log("ㅤ")
                    .log("--------------------------------------------")
                    .log("${body}")
                    .log("--------------------------------------------")
                    .log("ㅤ")
                    .log("transformando resposta do servico externo (json) para xml")
                    .to("xj:identity?transformDirection=JSON2XML")
                    .log("resposta transformada com sucesso")
                    .log("ㅤ")
                    .log("--------------------------------------------")
                    .log("${body}")
                    .log("--------------------------------------------")
                    .log("ㅤ");

            }
        });

        // Inicia o CamelContext
        context.start();

        // Aguardar para que as rotas sejam processadas
        Thread.sleep(60 * 60 * 1000);

        // Para o CamelContext após o processamento
        context.stop();
    }
}
