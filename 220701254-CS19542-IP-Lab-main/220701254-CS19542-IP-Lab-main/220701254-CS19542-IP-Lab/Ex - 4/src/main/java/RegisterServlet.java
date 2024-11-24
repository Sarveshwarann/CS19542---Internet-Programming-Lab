

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.io.PrintWriter;

@WebServlet("/RegisterServlet")
public class RegisterServlet extends HttpServlet {

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        // Set the response content type
        response.setContentType("text/html");
        
        // Get the form data
        String username = request.getParameter("username");
        String rollnumber = request.getParameter("rollnumber");
        String dept = request.getParameter("dept");
        String year = request.getParameter("year");
        String section = request.getParameter("section");
        String gender = request.getParameter("gender");
        String street = request.getParameter("street");
        String area = request.getParameter("area");
        String city = request.getParameter("city");
        String pincode = request.getParameter("pincode");
        String phone = request.getParameter("phone");
        String email = request.getParameter("email");

        // Write the response
        PrintWriter out = response.getWriter();
        out.println("<html><body>");
        out.println("<h2>Form Submission Details</h2>");
        out.println("<p><strong>Username:</strong> " + username + "</p>");
        out.println("<p><strong>Roll Number:</strong> " + rollnumber + "</p>");
        out.println("<p><strong>Department:</strong> " + dept + "</p>");
        out.println("<p><strong>Year:</strong> " + year + "</p>");
        out.println("<p><strong>Section:</strong> " + section + "</p>");
        out.println("<p><strong>Gender:</strong> " + gender + "</p>");
        out.println("<p><strong>Street:</strong> " + street + "</p>");
        out.println("<p><strong>Area:</strong> " + area + "</p>");
        out.println("<p><strong>City:</strong> " + city + "</p>");
        out.println("<p><strong>Pincode:</strong> " + pincode + "</p>");
        out.println("<p><strong>Phone Number:</strong> " + phone + "</p>");
        out.println("<p><strong>Email:</strong> " + email + "</p>");
        out.println("</body></html>");
    }
}
